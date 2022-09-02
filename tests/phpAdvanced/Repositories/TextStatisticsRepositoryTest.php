<?php

namespace Tests\phpAdvanced\Repositories;

use Carbon\Carbon;
use phpAdvanced\Entities\StatisticRecord;
use phpAdvanced\Repositories\TextStatisticsRepository;
use PHPUnit\Framework\TestCase;
use Tests\phpAdvanced\DoctrineTestCase;

class TextStatisticsRepositoryTest extends TestCase
{
    use DoctrineTestCase;

    protected TextStatisticsRepository $textStatisticsRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $em = $this->getEntityManager();

        $this->textStatisticsRepository = new TextStatisticsRepository($em);
    }

    public function testCreateWorksCorrectly()
    {
        $textHash = 'text hash';
        $statistic = ['test_stats' => 'test'];
        $sessionId = '1';

        $statisticRecord = $this->textStatisticsRepository->find(
            $this->textStatisticsRepository->create($textHash, $statistic, $sessionId)->getTextHash()
        );

        $this->assertInstanceOf(StatisticRecord::class, $statisticRecord);
        $this->assertSame($textHash, $statisticRecord->getTextHash());
        $this->assertSame($statistic, $statisticRecord->getStatistic());
        $this->assertSame($sessionId, $statisticRecord->getSessionId());
    }

    public function testFindWorksCorrectly()
    {
        $textHash = 'text hash';
        $statistic = ['test_stats' => 'test'];
        $sessionId = '1';

        $this->textStatisticsRepository->create($textHash, $statistic, $sessionId);

        $statisticRecord = $this->textStatisticsRepository->find($textHash);

        $this->assertInstanceOf(StatisticRecord::class, $statisticRecord);
        $this->assertSame($textHash, $statisticRecord->getTextHash());
        $this->assertSame($statistic, $statisticRecord->getStatistic());
        $this->assertSame($sessionId, $statisticRecord->getSessionId());
    }

    public function testGetAllWorksCorrectly()
    {
        $firstSessionId = '1';
        $secondSessionId = '2';

        $items = [
            [
                'textHash' => 'text hash 1',
                'statistic' => [],
                'sessionId' => $firstSessionId,
            ],
            [
                'textHash' => 'text hash 2',
                'statistic' => [],
                'sessionId' => $secondSessionId,
            ],
        ];

        foreach ($items as $item) {
            $this->textStatisticsRepository->create($item['textHash'], $item['statistic'], $item['sessionId']);
        }

        $firstSessionItems = $this->textStatisticsRepository->getAll(1);
        $secondSessionItems = $this->textStatisticsRepository->getAll(2);

        $this->assertIsArray($firstSessionItems);
        $this->assertInstanceOf(StatisticRecord::class, $firstSessionItems[0]);
        $this->assertSame($firstSessionId, $firstSessionItems[0]->getSessionId());

        $this->assertIsArray($secondSessionItems);
        $this->assertInstanceOf(StatisticRecord::class, $secondSessionItems[0]);
        $this->assertSame($secondSessionId, $secondSessionItems[0]->getSessionId());
    }

    public function testGetAllInDateRangeWorksCorrectly()
    {
        $sessionId = '1';

        $from = Carbon::now()->subDay()->toDateTimeString();
        $to = Carbon::now()->addDays(2)->toDateTimeString();

        $expectedItems = [
            [
                'textHash' => 'text hash 1',
                'statistic' => [],
                'sessionId' => $sessionId,
                'timestamp' => Carbon::now()->toDateTimeString(),
            ],
            [
                'textHash' => 'text hash 2',
                'statistic' => [],
                'sessionId' => $sessionId,
                'timestamp' => Carbon::now()->addDay()->toDateTimeString(),
            ],
        ];

        $allItems = array_merge($expectedItems, [
            [
                'textHash' => 'text hash 2',
                'statistic' => [],
                'sessionId' => $sessionId,
                'timestamp' => Carbon::now()->subWeek()->toDateTimeString(),
            ],
            [
                'textHash' => 'text hash 2',
                'statistic' => [],
                'sessionId' => '23test',
                'timestamp' => Carbon::now()->toDateTimeString(),
            ],
        ]);

        foreach ($allItems as $item) {
            $this->textStatisticsRepository->create($item['textHash'], $item['statistic'], $item['sessionId'], $item['timestamp']);
        }

        $actualItems = $this->textStatisticsRepository->getAllInDateRange($sessionId, $from, $to);

        $this->assertCount(count($expectedItems), $actualItems);

        for ($i = 0; $i < count($actualItems); $i++) {
            $this->assertSame($expectedItems[$i]['textHash'], $actualItems[$i]->getTextHash());
            $this->assertSame($expectedItems[$i]['statistic'], $actualItems[$i]->getStatistic());
            $this->assertSame($expectedItems[$i]['sessionId'], $actualItems[$i]->getSessionId());
            $this->assertSame($expectedItems[$i]['timestamp'], $actualItems[$i]->getTimestamp());
        }
    }
}