<?php

namespace phpAdvanced\Services;

use Exception;
use phpAdvanced\Services\TextStatisticsService;
use Symfony\Component\HttpFoundation\Response;

class AverageCalculationService
{
    public static function perform(array $data): array
    {
        $numberOfTexts = count($data);

        if ($numberOfTexts == 0) {
            throw new Exception('Wrong data range or zero texts proceeded.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $averageCharactersFrequency = self::getAverageCharactersFrequency($data);

        $executionTimes = array_column($data, TextStatisticsService::EXECUTION_TIME_KEY);
        $averageNumberOfWordsInSentence = array_column($data, TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY);
        $averageWordLength = array_column($data, TextStatisticsService::AVERAGE_WORD_LENGTH_KEY);
        $averageNumberOfCharacters = array_column($data, TextStatisticsService::NUMBER_OF_CHARACTERS_KEY);
        $averageNumberOfWords = array_column($data, TextStatisticsService::NUMBER_OF_WORDS_KEY);
        $averageNumberOfSentences = array_column($data, TextStatisticsService::NUMBER_OF_SENTENCES_KEY);
        $averageNumberOfPalindromeWords = array_column($data, TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY);

        return [
            'Number of submitted texts' => $numberOfTexts,
            TextStatisticsService::FREQUENCY_OF_CHARACTERS_KEY => $averageCharactersFrequency,
            TextStatisticsService::EXECUTION_TIME_KEY => array_sum($executionTimes) / count($executionTimes),
            TextStatisticsService::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => array_sum($averageNumberOfWordsInSentence) / count($averageNumberOfWordsInSentence),
            TextStatisticsService::AVERAGE_WORD_LENGTH_KEY => array_sum($averageWordLength) / count($averageWordLength),
            TextStatisticsService::NUMBER_OF_CHARACTERS_KEY => array_sum($averageNumberOfCharacters) / count($averageNumberOfCharacters),
            TextStatisticsService::NUMBER_OF_WORDS_KEY => array_sum($averageNumberOfWords) / count($averageNumberOfWords),
            TextStatisticsService::NUMBER_OF_SENTENCES_KEY => array_sum($averageNumberOfSentences) / count($averageNumberOfSentences),
            TextStatisticsService::NUMBER_OF_PALINDROME_WORDS_KEY => array_sum($averageNumberOfPalindromeWords) / count($averageNumberOfPalindromeWords),
            TextStatisticsService::TEN_MOST_USED_WORDS_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_MOST_USED_WORDS_KEY)),
            TextStatisticsService::TEN_LONGEST_WORDS_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_LONGEST_WORDS_KEY)),
            TextStatisticsService::TEN_SHORTEST_WORDS_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_SHORTEST_WORDS_KEY)),
            TextStatisticsService::TEN_LONGEST_SENTENCES_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_LONGEST_SENTENCES_KEY)),
            TextStatisticsService::TEN_SHORTEST_SENTENCES_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_SHORTEST_SENTENCES_KEY)),
            TextStatisticsService::TEN_LONGEST_PALINDROMES_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_LONGEST_PALINDROMES_KEY)),
            TextStatisticsService::TEN_SHORTEST_PALINDROMES_KEY => array_merge(...array_column($data, TextStatisticsService::TEN_SHORTEST_PALINDROMES_KEY)),
        ];
    }

    private static function getAverageCharactersFrequency(array $data): array
    {
        $charactersFrequency = array_column($data, TextStatisticsService::FREQUENCY_OF_CHARACTERS_KEY);
        $averageCharactersFrequency = [];

        foreach ($charactersFrequency as $singleTextCharactersFrequency) {
            foreach ($singleTextCharactersFrequency as $key => $value) {
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
