<?php

declare(strict_types=1);

use DarkDarin\Lowrapper\Converter;
use DarkDarin\Lowrapper\DocumentTypeEnum;
use DarkDarin\Lowrapper\Format\TextFormatEnum;
use DarkDarin\Lowrapper\Format\WebFormatEnum;
use DarkDarin\Lowrapper\LowrapperParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class ConverterTest extends TestCase
{
    /**
     * @dataProvider converterProvider
     */
    public function testConvert(LowrapperParameters $parameters, string $command, ?string $binary = null)
    {
        $processStub = $this->getMockBuilder(Process::class)
            ->disableOriginalConstructor()
            ->getMock();
        $processStub->method('run')->willReturn(0);

        $mockBuilder = $this->getMockBuilder(Converter::class);
        if ($binary) {
            $mockBuilder->setConstructorArgs([$binary]);
        }

        $converterStub = $mockBuilder->onlyMethods([
            'createProcess',
            'createTemporaryFile',
            'createOutput',
            'deleteInput',
            'genTemporaryFileName',
            'getInputFile',
        ])
            ->getMock();

        $converterStub->expects($this->once())
            ->method('createProcess')
            ->with($this->equalTo($command))
            ->willReturn($processStub);

        $converterStub
            ->method('createTemporaryFile')
            ->willReturn('some_temp_file');

        $converterStub->expects($this->once())
            ->method('createOutput')
            ->with($this->equalTo('some_temp_file.' . $parameters->getOutputFormat()->getFormat()));

        $converterStub
            ->method('genTemporaryFileName')
            ->willReturn('some_temp_file');

        $converterStub
            ->method('getInputFile')
            ->willReturn('some_temp_file');

        $converterStub->convert($parameters);
    }

    public static function converterProvider(): array
    {
        $command = 'libreoffice --headless --invisible --nocrashreport --nodefault --nofirststartwizard --nologo --norestore ';
        return [
            'From HTML file to HTML stdout' => [
                (new LowrapperParameters(WebFormatEnum::HTML))
                    ->setDocumentType(DocumentTypeEnum::WEB)
                    ->setInputFile('test.html')
                    ->setOutputFile('test.docx'),
                $command . '--web --convert-to "html" "some_temp_file"',
                null,
            ],
            'From HTML file to docx file' => [
                (new LowrapperParameters(TextFormatEnum::DOCX))
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentTypeEnum::WRITER)
                    ->setOutputFile('test.docx'),
                $command . '--writer --convert-to "docx" "some_temp_file"',
                null,
            ],
            'Default document type' => [
                (new LowrapperParameters(TextFormatEnum::DOCX))
                    ->setInputFile('test.html')
                    ->setOutputFile('test.docx'),
                $command . '--writer --convert-to "docx" "some_temp_file"',
                null,
            ],
            'Output filter' => [
                (new LowrapperParameters(TextFormatEnum::TEXT))
                    ->setInputFile('test.html')
                    ->setOutputFile('test.text')
                    ->addOutputFilter('some filter'),
                $command . '--writer --convert-to "text:some filter" "some_temp_file"',
                null,
            ],
            'Input filter' => [
                (new LowrapperParameters(TextFormatEnum::TEXT))
                    ->setInputFile('test.html')
                    ->setOutputFile('test.text')
                    ->setInputFilter('some'),
                $command . '--writer --infilter=some --convert-to "text:Text (encoded):UTF8" "some_temp_file"',
                null,
            ],
            'Default text filter' => [
                (new LowrapperParameters(TextFormatEnum::TEXT))
                    ->setInputFile('test.html')
                    ->setOutputFile('test.text'),
                $command . '--writer --convert-to "text:Text (encoded):UTF8" "some_temp_file"',
                null,
            ],
            'Input string' => [
                (new LowrapperParameters(TextFormatEnum::TEXT))
                    ->setInputData('example html content')
                    ->setOutputFile('test.text'),
                $command . '--writer --convert-to "text:Text (encoded):UTF8" "some_temp_file"',
                null,
            ],
            'Binary' => [
                (new LowrapperParameters(TextFormatEnum::DOCX))
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentTypeEnum::WRITER)
                    ->setOutputFile('test.docx'),
                str_replace('libreoffice', '/test/path', $command) . '--writer --convert-to "docx" "some_temp_file"',
                '/test/path',
            ],
        ];
    }

}
