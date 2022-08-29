<?php

namespace phpAdvanced\Services;

use Exception;
use phpAdvanced\Controllers\TextStatisticsController;
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

        $executionTimes = array_column($data, TextStatisticsController::EXECUTION_TIME_KEY);
        $averageNumberOfWordsInSentence = array_column($data, TextStatisticsController::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY);
        $averageWordLength = array_column($data, TextStatisticsController::AVERAGE_WORD_LENGTH_KEY);
        $averageNumberOfCharacters = array_column($data, TextStatisticsController::NUMBER_OF_CHARACTERS_KEY);
        $averageNumberOfWords = array_column($data, TextStatisticsController::NUMBER_OF_WORDS_KEY);
        $averageNumberOfSentences = array_column($data, TextStatisticsController::NUMBER_OF_SENTENCES_KEY);
        $averageNumberOfPalindromeWords = array_column($data, TextStatisticsController::NUMBER_OF_PALINDROME_WORDS_KEY);

        return [
            'Number of submitted texts' => $numberOfTexts,
            TextStatisticsController::FREQUENCY_OF_CHARACTERS_KEY => $averageCharactersFrequency,
            TextStatisticsController::EXECUTION_TIME_KEY => array_sum($executionTimes) / count($executionTimes),
            TextStatisticsController::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => array_sum($averageNumberOfWordsInSentence) / count($averageNumberOfWordsInSentence),
            TextStatisticsController::AVERAGE_WORD_LENGTH_KEY => array_sum($averageWordLength) / count($averageWordLength),
            TextStatisticsController::NUMBER_OF_CHARACTERS_KEY => array_sum($averageNumberOfCharacters) / count($averageNumberOfCharacters),
            TextStatisticsController::NUMBER_OF_WORDS_KEY => array_sum($averageNumberOfWords) / count($averageNumberOfWords),
            TextStatisticsController::NUMBER_OF_SENTENCES_KEY => array_sum($averageNumberOfSentences) / count($averageNumberOfSentences),
            TextStatisticsController::NUMBER_OF_PALINDROME_WORDS_KEY => array_sum($averageNumberOfPalindromeWords) / count($averageNumberOfPalindromeWords),
            TextStatisticsController::TEN_MOST_USED_WORDS_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_MOST_USED_WORDS_KEY)),
            TextStatisticsController::TEN_LONGEST_WORDS_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_LONGEST_WORDS_KEY)),
            TextStatisticsController::TEN_SHORTEST_WORDS_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_SHORTEST_WORDS_KEY)),
            TextStatisticsController::TEN_LONGEST_SENTENCES_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_LONGEST_SENTENCES_KEY)),
            TextStatisticsController::TEN_SHORTEST_SENTENCES_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_SHORTEST_SENTENCES_KEY)),
            TextStatisticsController::TEN_LONGEST_PALINDROMES_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_LONGEST_PALINDROMES_KEY)),
            TextStatisticsController::TEN_SHORTEST_PALINDROMES_KEY => array_merge(...array_column($data, TextStatisticsController::TEN_SHORTEST_PALINDROMES_KEY)),
        ];
    }

    private static function getAverageCharactersFrequency(array $data): array
    {
        $charactersFrequency = array_column($data, TextStatisticsController::FREQUENCY_OF_CHARACTERS_KEY);
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