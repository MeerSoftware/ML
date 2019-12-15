<?php

namespace Rubix\ML\Tests\Datasets\Extractors;

use Rubix\ML\Datasets\Extractors\NDJSONArray;
use Rubix\ML\Datasets\Extractors\Extractor;
use PHPUnit\Framework\TestCase;

class NDJSONArrayTest extends TestCase
{
    /**
     * @var \Rubix\ML\Datasets\Extractors\NDJSONArray;
     */
    protected $extractor;

    public function setUp() : void
    {
        $this->extractor = new NDJSONArray('tests/test_array.ndjson');
    }

    public function test_build_factory() : void
    {
        $this->assertInstanceOf(NDJSONArray::class, $this->extractor);
        $this->assertInstanceOf(Extractor::class, $this->extractor);
    }

    public function test_extract() : void
    {
        $records = $this->extractor->extract();

        $expected = [
            ['nice', 'furry', 'friendly', 4, 'not monster'],
            ['mean', 'furry', 'loner', -1.5, 'monster'],
            ['nice', 'rough', 'friendly', 2.6, 'not monster'],
            ['mean', 'rough', 'friendly', -1, 'monster'],
            ['nice', 'rough', 'friendly', 2.9, 'not monster'],
            ['nice', 'furry', 'loner', -5, 'not monster'],
        ];

        $records = is_array($records) ? $records : iterator_to_array($records);

        $this->assertEquals($expected, array_values($records));
    }
}