<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Services/AnimeService.php';

class AnimeServiceTest extends TestCase
{
    public function testFormatDate()
    {
        $service = new AnimeService();

        $this->assertEquals(
            '07-04-2013',
            $service->formatDate('2013-04-07')
        );
    }
}