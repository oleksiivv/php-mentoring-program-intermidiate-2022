<?php

namespace phpAdvanced\Services;

use phpAdvanced\Repositories\TextStatisticsRepository;

class TextStatisticsService
{
    public const NUMBER_OF_CHARACTERS_KEY = 'number of characters';
    public const NUMBER_OF_WORDS_KEY = 'number of words';
    public const NUMBER_OF_SENTENCES_KEY = 'number of sentences';
    public const FREQUENCY_OF_CHARACTERS_KEY = 'frequency of characters';
    public const DISTRIBUTION_OF_CHARACTERS_KEY = 'distribution of characters';
    public const AVERAGE_WORD_LENGTH_KEY = 'average word length';
    public const AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY = 'average number of words in sentence';
    public const TEN_MOST_USED_WORDS_KEY = 'ten most used words';
    public const TEN_LONGEST_WORDS_KEY = 'ten longest words';
    public const TEN_SHORTEST_WORDS_KEY = 'ten shortest words';
    public const TEN_LONGEST_SENTENCES_KEY = 'ten longest sentences';
    public const TEN_SHORTEST_SENTENCES_KEY = 'ten shortest sentences';
    public const NUMBER_OF_PALINDROME_WORDS_KEY = 'number of palindrome words';
    public const TEN_LONGEST_PALINDROMES_KEY = 'ten longest palindromes';
    public const TEN_SHORTEST_PALINDROMES_KEY = 'ten shortest palindromes';
    public const IS_PALINDROME_KEY = 'is palindrome';
    public const EXECUTION_TIME_KEY = 'execution time';

    private String $text;

    private TextStatisticsRepository $textStatisticsRepository;

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setTextStatisticsRepository(TextStatisticsRepository $textStatisticsRepository): void
    {
        $this->textStatisticsRepository = $textStatisticsRepository;
    }

    public function getTextStatisticsRepository(): TextStatisticsRepository
    {
        return $this->textStatisticsRepository;
    }

    public function processText(string $sessionId): array
    {
        $textSha = $this->getHash();

        $statisticRecord = $this->textStatisticsRepository->find($textSha);

        if ($statisticRecord != null) {
            return $statisticRecord->getStatistic();
        }

        $timeStart = microtime(true);

        $result = [
            'text' => $this->text,
            'text hash' => $textSha,
            self::NUMBER_OF_CHARACTERS_KEY => $this->getNumberOfCharacters(),
            self::NUMBER_OF_WORDS_KEY => $this->getNumberOfWords(),
            self::NUMBER_OF_SENTENCES_KEY => $this->getNumberOfSentences(),
            self::FREQUENCY_OF_CHARACTERS_KEY => $this->getCharactersFrequency(),
            self::DISTRIBUTION_OF_CHARACTERS_KEY => $this->getCharactersDistributionAsPercentageOfTotal(),
            self::AVERAGE_WORD_LENGTH_KEY => $this->getAverageWordLength(),
            self::AVERAGE_NUMBER_OF_WORDS_IN_SENTENCE_KEY => $this->getAverageNumberOfWordsInSentence(),
            self::TEN_MOST_USED_WORDS_KEY => $this->getMostUsedWords(10),
            self::TEN_LONGEST_WORDS_KEY => $this->getLongestWords(10),
            self::TEN_SHORTEST_WORDS_KEY => $this->getShortestWords(10),
            self::TEN_LONGEST_SENTENCES_KEY => $this->getLongestSentences(10),
            self::TEN_SHORTEST_SENTENCES_KEY => $this->getShortestSentences(10),
            self::NUMBER_OF_PALINDROME_WORDS_KEY => $this->getNumberOfPalindromes(),
            self::TEN_LONGEST_PALINDROMES_KEY => $this->getLongestPalindromes(10),
            self::TEN_SHORTEST_PALINDROMES_KEY => $this->getShortestPalindromes(10),
            self::IS_PALINDROME_KEY => $this->isPalindrome() ? 'yes' : 'not',
            'generated at' => date("Y-m-d H:i:s"),
            'reversed text' => $this->getReversed(),
            'text in reversed order' => $this->getInReversedOrder(),
        ];

        $timeEnd = microtime(true);

        $executionTime = ($timeEnd - $timeStart) / 60;

        $result[self::EXECUTION_TIME_KEY] = $executionTime;

        return $this->textStatisticsRepository->create($textSha, $result, $sessionId)->getStatistic();
    }

    public function getNumberOfCharacters(): int
    {
        return mb_strlen($this->text);
    }

    public function getNumberOfWords(): int
    {
        return count($this->getWords());
    }

    public function getNumberOfSentences(): int
    {
        return count($this->getSentences());
    }

    public function getCharactersFrequency(): array
    {
        $frequency = mb_str_split(mb_strtolower($this->text));

        $frequency = array_count_values($frequency);

        arsort($frequency);

        return $frequency;
    }

    public function getCharactersDistributionAsPercentageOfTotal(): array
    {
        $totalNumberOfCharacters = $this->getNumberOfCharacters();
        $frequency = $this->getCharactersFrequency();

        foreach ($frequency as $key => $value) {
            $frequency[$key] = $value * 100 / $totalNumberOfCharacters;
        }

        arsort($frequency);

        return $frequency;
    }

    public function getAverageWordLength(): ?int
    {
        $wordsLength = array_map(function ($item) {
            return mb_strlen($item);
        }, $this->getWords());

        $wordsCount = count($wordsLength);

        if ($wordsCount > 0) {
            return array_reduce($wordsLength, function ($sum, $item) {
                    return $sum += $item;
                }) / $wordsCount;
        }

        return null;
    }

    public function getAverageNumberOfWordsInSentence(): int
    {
        return $this->getNumberOfWords() / $this->getNumberOfSentences();
    }

    public function getMostUsedWords(int $limit): array
    {
        $words = $this->getWords();

        $wordsFrequency = array_count_values($words);

        arsort($wordsFrequency);

        return array_slice($wordsFrequency, 0, $limit);
    }

    public function getLongestWords(int $limit): array
    {
        $wordsLengths = $this->getEachWordLengthFromText($this->text);

        arsort($wordsLengths);

        return array_slice($wordsLengths, 0, $limit);
    }

    public function getShortestWords(int $limit): array
    {
        $wordsLengths = $this->getEachWordLengthFromText($this->text);

        asort($wordsLengths);

        return array_slice($wordsLengths, 0, $limit);
    }

    public function getLongestSentences(int $limit): array
    {
        $sentencesLengths = $this->getEachSentenceLength();

        arsort($sentencesLengths);

        return array_slice($sentencesLengths, 0, $limit);
    }

    public function getShortestSentences(int $limit): array
    {
        $sentencesLengths = $this->getEachSentenceLength();

        asort($sentencesLengths);

        return array_slice($sentencesLengths, 0, $limit);
    }

    public function getNumberOfPalindromes(): int
    {
        $words = $this->getWords();
        $count = 0;

        foreach ($words as $word) {
            if ($this->getReversedString($word) === $word) {
                $count++;
            }
        }

        return $count;
    }

    public function getLongestPalindromes(int $limit): array
    {
        $palindromesLengths = $this->getEachPalindromeLength();

        arsort($palindromesLengths);

        return array_slice($palindromesLengths, 0, $limit);
    }

    public function getShortestPalindromes(int $limit): array
    {
        $palindromesLengths = $this->getEachPalindromeLength();

        asort($palindromesLengths);

        return array_slice($palindromesLengths, 0, $limit);
    }

    public function isPalindrome(): bool
    {
        $charsToBeRemoved = ['?', '!', ',', ';', ':', ' ', '.'];

        $onlyText = str_replace($charsToBeRemoved, '', $this->text);
        $onlyText = mb_strtolower($onlyText);

        return $onlyText === $this->getReversedString($onlyText);
    }

    public function getReversed(): string
    {
        return $this->getReversedString($this->text);
    }

    public function getInReversedOrder(): string
    {
        $punctuationSigns = ['?', '!', ',', ';', ':', ' ', '.'];

        $temp = '';
        $out = '';
        $i = 0;
        while ($i < strlen($this->text))
        {
            $symbol = $this->text[$i];

            if (in_array($symbol, $punctuationSigns)) {
                $out = $symbol . $temp . $out;
                $temp = '';
            } else {
                $temp .= $symbol;
            }

            $i++;
        }

        return $temp . $out;
    }

    public function getHash(): string
    {
        return sha1($this->text);
    }

    private function getWords(): array
    {
        $charsToBeRemoved = ['?', '!', ',', ';', ':', '.'];

        $onlyText = str_replace($charsToBeRemoved, '', $this->text);

        return preg_split('/\s+/', $onlyText);
    }

    private function getSentences(): array
    {
        return preg_split('/(?<=[.!?])\s+/u', $this->text, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    }

    private function getEachSentenceLength(): array
    {
        $sentences = $this->getSentences();
        $sentencesLengths = [];

        foreach ($sentences as $sentence) {
            $sentencesLengths[$sentence] = mb_strlen($sentence);
        }

        return $sentencesLengths;
    }

    private function getEachPalindromeLength(): array
    {
        $words = $this->getWords();

        $palindromes = array_filter($words, function ($item) {
            return $this->getReversedString($item) === $item;
        });

        return $this->getEachWordLengthFromArray($palindromes);
    }

    private function getEachWordLengthFromText(string $text): array
    {
        $words = $this->getWords();

        return $this->getEachWordLengthFromArray($words);
    }

    private function getEachWordLengthFromArray(array $words): array
    {
        $wordsLengths = [];

        foreach ($words as $word) {
            $wordsLengths[$word] = mb_strlen($word);
        }

        return $wordsLengths;
    }

    private function getReversedString(string $text): string
    {
        preg_match_all('/./us', $text, $stringAsArray);

        return join('', array_reverse($stringAsArray[0]));
    }
}