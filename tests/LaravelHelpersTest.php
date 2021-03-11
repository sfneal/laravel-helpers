<?php

namespace Sfneal\Helpers\Laravel\Tests;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Sfneal\Helpers\Laravel\LaravelHelpers;

class LaravelHelpersTest extends TestCase
{
    /** @test */
    public function alphabet()
    {
        $expected = range('A', 'Z');
        $output = LaravelHelpers::alphabet();

        $this->assertEquals($output, $expected);
    }

    /**
     * @test
     * @throws Exception
     */
    public function alphabetIndex()
    {
        $index = random_int(1, 25);
        $expected = LaravelHelpers::alphabet()[$index];
        $output = LaravelHelpers::alphabetIndex($index);

        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function getClassName()
    {
        $expected = 'Illuminate\Database\Eloquent\Model';
        $output = LaravelHelpers::getClassName(Model::class);

        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function getClassName_short()
    {
        $expected = 'Model';
        $output = LaravelHelpers::getClassName(Model::class, true);

        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function serializeHash()
    {
        $expected = 1106692049;
        $output = LaravelHelpers::serializeHash("Here's a random string to hash.");

        $this->assertIsInt($output);
        $this->assertEquals($output, $expected);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function randomFloat()
    {
        $value = LaravelHelpers::randomFloat(1, 1000);

        $this->assertIsFloat($value);
    }

    /** @test */
    public function isBinary()
    {
        $binary = "%PDF-1.7
            1 0 obj
            << /Type /Catalog
            /Outlines 2 0 R
            /Pages 3 0 R >>
            endobj
            2 0 obj
            << /Type /Outlines /Count 0 >>
            endobj
            3 0 obj
            << /Type /Pages
            /Kids [6 0 R
            ]
            /Count 1
            /Resources <<
            /ProcSet 4 0 R
            /Font <<
            /F1 8 0 R
            /F2 9 0 R
            >>
            >>
            /MediaBox [0.000 0.000 612.000 792.000]
             >>
            endobj
            4 0 obj
            [/PDF /Text ]
            endobj
            5 0 obj
            <<
            /Producer (��dompdf <3d9cb4c8> + CPDF)
            /CreationDate (D:20210219180738+00'00')
            /ModDate (D:20210219180738+00'00')
            >>
            endobj
            6 0 obj
            << /Type /Page
            /MediaBox [0.000 0.000 612.000 792.000]
            /Parent 3 0 R
            /Contents 7 0 R
            >>
            endobj
            7 0 obj
            << /Filter /FlateDecode
            /Length 72 >>
            stream
            x��2�300P@&�ҹ�B�M�

            -�                ��
              ,MBR��
                    ���
            !i

            �!��%
            N9�)���
            !^
            �!S�;
            endstream
            endobj
            8 0 obj
            << /Type /Font
            /Subtype /Type1
            /Name /F1
            /BaseFont /Times-Bold
            /Encoding /WinAnsiEncoding
            >>
            endobj
            9 0 obj
            << /Type /Font
            /Subtype /Type1
            /Name /F2
            /BaseFont /Times-Roman
            /Encoding /WinAnsiEncoding
            >>
            endobj
            xref
            0 10
            0000000000 65535 f
            0000000009 00000 n
            0000000074 00000 n
            0000000120 00000 n
            0000000284 00000 n
            0000000313 00000 n
            0000000472 00000 n
            0000000575 00000 n
            0000000718 00000 n
            0000000826 00000 n
            trailer
            <<
            /Size 10
            /Root 1 0 R
            /Info 5 0 R
            /ID[<5e2904341e493fa6f0fe8005871e76ac><5e2904341e493fa6f0fe8005871e76ac>]
            >>
            startxref
            935
            %%EOF
        ";
        $string = "Here's a string that isn't binary.";
        $isBinary = LaravelHelpers::isBinary($binary);
        $isNotBinary = LaravelHelpers::isBinary($string);

        $this->assertTrue($isBinary);
        $this->assertFalse($isNotBinary);
    }

    /** @test */
    public function isSerialized()
    {
        $array = ['key' => 'value'];
        $value = serialize($array);
        $isSerialized = LaravelHelpers::isSerialized($value);
        $isNotSerialized = LaravelHelpers::isSerialized($array);

        $this->assertTrue($isSerialized);
        $this->assertFalse($isNotSerialized);
    }

    /** @test */
    public function formatNumber()
    {
        $data = [
            900 => '900',
            10000 => '10k',
            15000 => '15k',
            30500 => '30.5k',
            701500 => '701.5k',
            16033 => '16k',
            16333 => '16.3k',
        ];

        foreach ($data as $number => $expected) {
            $output = LaravelHelpers::formatNumber($number);

            $this->assertIsString($output);
            $this->assertEquals($expected, $output);
        }
    }
}
