<?php

declare(strict_types=1);

namespace DarkDarin\Lowrapper;

use DarkDarin\Lowrapper\Format\FormatInterface;

/**
 * @api
 */
class LowrapperParameters
{
    /**
     * Full path to output file. In case when output is stdout - null.
     */
    protected ?string $outputFile = null;

    /**
     * Output format.
     */
    protected FormatInterface $outputFormat;

    /**
     * Document type
     *
     * information from `libreoffice --help`:
     * --writer       create new text document.
     * --calc         create new spreadsheet document.
     * --draw         create new drawing.
     * --impress      create new presentation.
     * --base         create new database.
     * --math         create new formula.
     * --global       create new global document.
     * --web          create new HTML document.
     */
    protected ?DocumentTypeEnum $documentType = null;

    /**
     * Full path to input file. In case when input is stdin - null.
     */
    protected ?string $inputFile = null;

    /**
     * Input data, eg. HTML as string
     */
    protected mixed $inputData = null;

    /**
     * Output filters, eg.
     * - Text (encoded)
     * - UTF8
     * @var string[]
     */
    protected array $outputFilters = [];

    /**
     * Input filters, eg.
     * - Text (encoded)
     * - UTF8
     */
    protected ?string $inputFilter = null;

    public function __construct(
        FormatInterface $outputFormat,
        ?string $outputFile = null,
        ?string $inputFile = null,
    ) {
        $this->setOutputFormat($outputFormat);
        $this->setOutputFile($outputFile);
        $this->setInputFile($inputFile);
    }

    /**
     * @psalm-mutation-free
     */
    public function getInputFile(): ?string
    {
        return $this->inputFile;
    }

    public function setInputFile(?string $inputFile): self
    {
        $this->inputFile = $inputFile;
        return $this;
    }

    /**
     * @psalm-mutation-free
     */
    public function getOutputFile(): ?string
    {
        return $this->outputFile;
    }

    public function setOutputFile(?string $outputFile): self
    {
        $this->outputFile = $outputFile;
        return $this;
    }

    /**
     * @psalm-mutation-free
     */
    public function getOutputFormat(): FormatInterface
    {
        return $this->outputFormat;
    }

    /**
     * @throws LowrapperException
     */
    public function setOutputFormat(FormatInterface $outputFormat): self
    {
        $this->outputFormat = $outputFormat;
        return $this;
    }

    /**
     * @psalm-mutation-free
     */
    public function getDocumentType(): ?DocumentTypeEnum
    {
        return $this->documentType;
    }

    /**
     * @throws LowrapperException
     */
    public function setDocumentType(DocumentTypeEnum $documentType): self
    {
        $this->documentType = $documentType;
        return $this;
    }

    public function addOutputFilter(string $outputFilter): self
    {
        $this->outputFilters[] = $outputFilter;
        return $this;
    }

    /**
     * @return string[]
     * @psalm-mutation-free
     */
    public function getOutputFilters(): array
    {
        return $this->outputFilters;
    }

    public function setInputFilter(string $inputFilter): self
    {
        $this->inputFilter = $inputFilter;
        return $this;
    }

    /**
     * @psalm-mutation-free
     */
    public function getInputFilter(): ?string
    {
        return $this->inputFilter;
    }

    /**
     * @psalm-mutation-free
     */
    public function getInputData(): mixed
    {
        return $this->inputData;
    }

    public function setInputData(mixed $inputData): self
    {
        $this->inputData = $inputData;
        return $this;
    }
}
