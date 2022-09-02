<?php

namespace phpAdvanced\Services;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AverageCalculationService
{
    public const NUMBER_OF_SUBMITTED_TEXTS_KEY = 'Number of submitted texts';

    public const INVALID_DATA_ERROR_MESSAGE = 'Wrong data range or zero texts proceeded.';

    public function perform(array $data): array
    {
        $numberOfTexts = count($data);

        if ($numberOfTexts == 0) {
            throw new Exception(self::INVALID_DATA_ERROR_MESSAGE, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return [
            self::NUMBER_OF_SUBMITTED_TEXTS_KEY => $numberOfTexts,
            TextStatisticsService::FREQUENCY_OF_CHARACTERS_KEY => $this->getAverageCharactersFrequency($data),
            TextStatisticsService::EXECUTION_TIME_KEY => $this->getAverageExecutionTime($data, $numberOfTexts),
            TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => $this->getAverageNumberOfWordsInSentence($data, $numberOfTexts),
            TextStatisticsService::AVERAGE_WORD_LENGTH_KEY => $this->getAverageWordLength($data, $numberOfTexts),
            TextStatisticsService::NUMBER_OF_CHARACTERS_KEY => $this->getAverageNumberOfCharacters($data, $numberOfTexts),
            TextStatisticsService::NUMBER_OF_WORDS_KEY => $this->getAverageNumberOfWords($data, $numberOfTexts),
            TextStatisticsService::NUMBER_OF_SENTENCES_KEY => $this->getAverageNumberOfSentence($data, $numberOfTexts),
            TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY => $this->getAverageNumberOfPalindromeWords($data, $numberOfTexts),
            TextStatisticsService::TEN_MOST_USED_WORDS_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_MOST_USED_WORDS_KEY, 10),
            TextStatisticsService::TEN_LONGEST_WORDS_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_SHORTEST_WORDS_KEY, 10),
            TextStatisticsService::TEN_SHORTEST_WORDS_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_SHORTEST_WORDS_KEY, 10),
            TextStatisticsService::TEN_LONGEST_SENTENCES_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_LONGEST_SENTENCES_KEY, 10),
            TextStatisticsService::TEN_SHORTEST_SENTENCES_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_SHORTEST_SENTENCES_KEY, 10),
            TextStatisticsService::TEN_LONGEST_PALINDROMES_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_LONGEST_PALINDROMES_KEY, 10),
            TextStatisticsService::TEN_SHORTEST_PALINDROMES_KEY => $this->getAllFromColumn($data, TextStatisticsService::TEN_SHORTEST_PALINDROMES_KEY, 10),
        ];
    }

    public function getAverageExecutionTime(array $data, int $numberOfTexts): float|int
    {
        return array_sum(array_column($data, TextStatisticsService::EXECUTION_TIME_KEY)) / $numberOfTexts;
    }

    public function getAverageNumberOfWordsInSentence(array $data, int $numberOfTexts): float|int
    {
        $averageNumberOfWordsInSentence = array_column($data, TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY);

        return array_sum($averageNumberOfWordsInSentence) / $numberOfTexts;
    }

    public function getAverageWordLength(array $data, int $numberOfTexts): float|int
    {
        $averageWordLength = array_column($data, TextStatisticsService::AVERAGE_WORD_LENGTH_KEY);

        return array_sum($averageWordLength) / $numberOfTexts;
    }

    public function getAverageNumberOfCharacters(array $data, int $numberOfTexts): float|int
    {
        $averageNumberOfCharacters = array_column($data, TextStatisticsService::NUMBER_OF_CHARACTERS_KEY);

        return array_sum($averageNumberOfCharacters) / $numberOfTexts;
    }

    public function getAverageNumberOfWords(array $data, int $numberOfTexts): float|int
    {
        $averageNumberOfWords = array_column($data, TextStatisticsService::NUMBER_OF_WORDS_KEY);

        return array_sum($averageNumberOfWords) / $numberOfTexts;
    }

    public function getAverageNumberOfSentence(array $data, int $numberOfTexts): float|int
    {
        $averageNumberOfSentences = array_column($data, TextStatisticsService::NUMBER_OF_SENTENCES_KEY);

        return array_sum($averageNumberOfSentences) / $numberOfTexts;
    }

    public function getAverageNumberOfPalindromeWords(array $data, int $numberOfTexts): float|int
    {
        $averageNumberOfPalindromeWords = array_column($data, TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY);

        return array_sum($averageNumberOfPalindromeWords) / $numberOfTexts;
    }

    public function getAllFromColumn(array $data, string $key, int $limit): array
    {
        return array_slice(array_merge(...array_column($data, $key)), 0, $limit);
    }

    public function getAverageCharactersFrequency(array $data): array
    {
        $charactersFrequency = array_column($data, TextStatisticsService::FREQUENCY_OF_CHARACTERS_KEY);
        $averageCharactersFrequency = [];

        foreach ($charactersFrequency as $singleTextCharactersFrequency) {
            foreach ($singleTextCharactersFrequency as $key=>$value) {
                if (isset($averageCharactersFrequency[$key])) {
                    $averageCharactersFrequency[$key] += $value;
                } else {
                    $averageCharactersFrequency[$key] = $value;
                }
            }
        }

        return array_map(function ($item) use ($charactersFrequency) {
            return $item / count($charactersFrequency);
        }, $averageCharactersFrequency);
    }
}