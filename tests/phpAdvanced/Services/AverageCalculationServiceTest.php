<?php

namespace Tests\phpAdvanced\Services;

use Exception;
use phpAdvanced\Services\AverageCalculationService;
use phpAdvanced\Services\TextStatisticsService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class AverageCalculationServiceTest extends TestCase
{
    public function testGetAverageExecutionTimeWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::EXECUTION_TIME_KEY => 4,
            ],
            [
                TextStatisticsService::EXECUTION_TIME_KEY => 6,
            ],
            [
                TextStatisticsService::EXECUTION_TIME_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageExecutionTime($data, count($data)));
    }

    public function testGetAverageNumberOfWordsInSentenceWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => 4,
            ],
            [
                TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => 6,
            ],
            [
                TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageNumberOfWordsInSentence($data, count($data)));
    }

    public function testGetAverageWordLengthWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::AVERAGE_WORD_LENGTH_KEY => 4,
            ],
            [
                TextStatisticsService::AVERAGE_WORD_LENGTH_KEY => 6,
            ],
            [
                TextStatisticsService::AVERAGE_WORD_LENGTH_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageWordLength($data, count($data)));
    }

    public function testGetAverageNumberOfCharactersWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::NUMBER_OF_CHARACTERS_KEY => 4,
            ],
            [
                TextStatisticsService::NUMBER_OF_CHARACTERS_KEY => 6,
            ],
            [
                TextStatisticsService::NUMBER_OF_CHARACTERS_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageNumberOfCharacters($data, count($data)));
    }

    public function testGetAverageNumberOfWordsWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::NUMBER_OF_WORDS_KEY => 4,
            ],
            [
                TextStatisticsService::NUMBER_OF_WORDS_KEY => 6,
            ],
            [
                TextStatisticsService::NUMBER_OF_WORDS_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageNumberOfWords($data, count($data)));
    }

    public function testGetAverageNumberOfSentencesWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::NUMBER_OF_SENTENCES_KEY => 4,
            ],
            [
                TextStatisticsService::NUMBER_OF_SENTENCES_KEY => 6,
            ],
            [
                TextStatisticsService::NUMBER_OF_SENTENCES_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageNumberOfSentence($data, count($data)));
    }

    public function testGetAverageNumberOfPalindromesWordsWorksCorrectly()
    {
        $data = [
            [
                TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY => 4,
            ],
            [
                TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY => 6,
            ],
            [
                TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY => 2,
            ],
        ];

        $this->assertSame(4, (new AverageCalculationService())->getAverageNumberOfPalindromeWords($data, count($data)));
    }

    public function testGetAllDataFromColumnWorksCorrectly()
    {
        $dataFromColumns = [['Batman'], ['Robin'], ['Batgirl']];
        $transformedDataFromColumns = ['Batman', 'Robin'];

        $key = TextStatisticsService::TEN_SHORTEST_WORDS_KEY;

        $data = [];

        foreach ($dataFromColumns as $column) {
            $data[] = [
                $key => $column,
            ];
        }

        $this->assertSame(
            $transformedDataFromColumns,
            (new AverageCalculationService())->getAllFromColumn($data, $key, count($transformedDataFromColumns)),
        );
    }

    public function testPerformThrowsExceptionWhenPassEmptyArray()
    {
        $this->expectException(Exception::class);
        $this->expectDeprecationMessage(AverageCalculationService::INVALID_DATA_ERROR_MESSAGE);
        $this->expectExceptionCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        (new AverageCalculationService())->perform([]);
    }
}