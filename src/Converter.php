<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Process\Process;

/**
 * @api
 */
class Converter implements ConverterInterface
{
    use LoggerAwareTrait;

    public const BINARY_DEFAULT = 'libreoffice';

    /**
     * Path to binary
     */
    protected string $binaryPath;

    /**
     * Temporary path (by defaults is equal to sys_get_temp_dir())
     */
    protected string $tempDir;

    /**
     * Timeout
     */
    protected int|null $timeout;

    /**
     * Prefix for temporary file names
     */
    protected string $tempPrefix;

    /**
     * The environment variables or null to use the same environment as the current PHP process
     */
    protected ?array $env;

    /**
     * Default options for libreoffice
     */
    protected array $defaultOptions = [
        '--headless',
        '--invisible',
        '--nocrashreport',
        '--nodefault',
        '--nofirststartwizard',
        '--nologo',
        '--norestore',
    ];

    public function __construct(
        string          $binaryPath = self::BINARY_DEFAULT,
        ?string         $tempDir = null,
        ?int            $timeout = null,
        LoggerInterface $logger = null,
        string          $tempPrefix = 'lowrapper_',
        ?array          $env = null,
    ) {
        if (!$logger) {
            $logger = new NullLogger();
        }
        $this->setLogger($logger);
        $this->binaryPath = $binaryPath;

        $this->tempDir = $tempDir !== null ? $tempDir : sys_get_temp_dir();
        if (str_ends_with($this->tempDir, '/')) {
            $this->tempDir = substr($this->tempDir, 0, -1);
        }

        $this->timeout = $timeout;
        $this->tempPrefix = $tempPrefix;
        $this->env = $env;
    }

    /**
     * @inheritdoc
     * @psalm-suppress MissingClosureParamType
     */
    public function convert(LowrapperParameters $parameters): ?string
    {
        $documentType = $parameters->getDocumentType() ?: $parameters->getOutputFormat()->getDocumentType();

        $inputFile = $this->getInputFile($parameters);
        $outputFilters = implode('', array_map(function ($item) {
            return ':' . $item;
        }, $this->getOutputFilters($parameters)));

        $options = array_merge($this->defaultOptions, [
            '--' . $documentType->value,
            $parameters->getInputFilter() !== null ? sprintf('--infilter=%s', $parameters->getInputFilter()) : null,
            '--convert-to "' . $parameters->getOutputFormat()->getFormat() . $outputFilters . '"',
            '"' . $inputFile . '"',
        ]);
        $command = $this->binaryPath . ' ' . implode(' ', array_filter($options));

        $process = $this->createProcess($command);

        if ($this->timeout !== null) {
            $process->setTimeout($this->timeout);
        }

        $this->logger?->info(sprintf('Start: %s', $command));

        $self = $this;
        $resultCode = $process->run(function ($type, $buffer) use ($self) {
            if (Process::ERR === $type) {
                $self->logger?->warning($buffer);
            } else {
                $self->logger?->info($buffer);
            }
        });

        $result = $this->createOutput($inputFile . '.' . $parameters->getOutputFormat()->getFormat(), $parameters->getOutputFile());
        $this->deleteInput($inputFile);

        if ($resultCode != 0) {
            $this->logger?->error(sprintf('Failed with result code %d: %s', $resultCode, $command));
            throw new LowrapperException('Error on converting data with LibreOffice: ' . $resultCode, $resultCode);
        } else {
            $this->logger?->info(sprintf('Finished: %s', $command));
        }

        return $result;
    }

    public function addOption(string $option): self
    {
        $this->defaultOptions[] = $option;

        return $this;
    }

    protected function createProcess(string $command): Process
    {
        return Process::fromShellCommandline($command, $this->tempDir, $this->env);
    }

    protected function createTemporaryFile(string $inputFile): string
    {
        $temporaryFile = $this->genTemporaryFileName();
        copy($inputFile, $temporaryFile);
        return $temporaryFile;
    }

    /**
     * Generate unique name for temporary file
     */
    protected function genTemporaryFileName(): string
    {
        return $this->tempDir . '/' . uniqid($this->tempPrefix);
    }

    /**
     * @throws LowrapperException
     */
    protected function createOutput(string $inputFile, ?string $outputFile = null): null|string
    {
        if (!file_exists($inputFile)) {
            $this->logger?->error('LibreOffice did not convert, check its working capacity');
            throw new LowrapperException('LibreOffice did not convert, check its working capacity');
        }
        if ($outputFile !== null) {
            if (file_exists($outputFile)) {
                unlink($outputFile);
            }
            rename($inputFile, $outputFile);
            return null;
        }

        $result = file_get_contents($inputFile);
        if ($result === false) {
            return null;
        }

        unlink($inputFile);
        return $result;
    }

    /**
     * Get output filters
     * @return string[]
     */
    protected function getOutputFilters(LowrapperParameters $parameters): array
    {
        if (empty($parameters->getOutputFilters())) {
            return OutputFilters::getDefault($parameters->getOutputFormat());
        }
        return $parameters->getOutputFilters();
    }

    /**
     * Get input file - return existed or create from input data
     */
    protected function getInputFile(LowrapperParameters $parameters): string
    {
        if ($parameters->getInputFile() !== null) {
            return $this->createTemporaryFile($parameters->getInputFile());
        }

        $temporaryFile = $this->genTemporaryFileName();
        file_put_contents($temporaryFile, $parameters->getInputData());
        return $temporaryFile;
    }

    /**
     * Delete input file if it was created in process of conversion
     */
    protected function deleteInput(string $inputFile): void
    {
        unlink($inputFile);
    }
}
