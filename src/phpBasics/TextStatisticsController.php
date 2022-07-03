<?php

namespace src\phpBasics;

class TextStatisticsController
{
    private String $text;

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getNumberOfCharacters(): int
    {
        return strlen($this->text);
    }

    public function getNumberOfWords(): int
    {
        return str_word_count($this->text);
    }

    public function getNumberOfSentences(): int
    {
        return count($this->getSentences());
    }

    public function getCharactersFrequency(): array
    {
        $asciiFrequency = count_chars(strtolower($this->text), 1);
        $frequency = [];

        foreach ($asciiFrequency as $key=>$value) {
            $frequency[chr($key)] = $value;
        }

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
            return strlen($item);
        }, str_word_count($this->text, 1));

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
        $words = str_word_count($this->text, 1);

        $wordsFrequency = array_count_values($words);

        arsort($wordsFrequency);

        return array_slice($wordsFrequency, 0, $limit);
    }

    private function getEachSentenceLength(): array
    {
        $sentences = $this->getSentences();
        $sentencesLengths = [];

        foreach ($sentences as $sentence) {
            $sentencesLengths[$sentence] = strlen($sentence);
        }

        return $sentencesLengths;
    }

    private function getSentences(): array
    {
        return preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $this->text);
    }

    private function getEachPalindromeLength(): array
    {
        $words = preg_split('/\s+/', $this->text);

        $palindromes = array_filter($words, function ($item) {
            return strrev($item) === $item;
        });

        return $this->getEachWordLengthFromArray($palindromes);
    }

    private function getEachWordLengthFromText(string $text): array
    {
        $words = str_word_count($text, 1);

        return $this->getEachWordLengthFromArray($words);
    }

    private function getEachWordLengthFromArray(array $words): array
    {
        $wordsLengths = [];

        foreach ($words as $word) {
            $wordsLengths[$word] = strlen($word);
        }

        return $wordsLengths;
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
        $words = preg_split('/\s+/', $this->text);
        $count = 0;

        foreach ($words as $word) {
            if (strrev($word) === $word) {
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
        $onlyText = strtolower($onlyText);

        return $onlyText === strrev($onlyText);
    }

    public function getReversed(): string
    {
        return strrev($this->text);
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

    public function processText(): array
    {
        $timeStart = microtime(true);

        $result = [
            'text' => $this->text,
            'number of characters' => $this->getNumberOfCharacters(),
            'number of words' => $this->getNumberOfWords(),
            'number of sentences' => $this->getNumberOfSentences(),
            'frequency of characters' => $this->getCharactersFrequency(),
            'distribution of characters' => $this->getCharactersDistributionAsPercentageOfTotal(),
            'average word length' => $this->getAverageWordLength(),
            'average number of words in sentence' => $this->getAverageNumberOfWordsInSentence(),
            'ten most used words' => $this->getMostUsedWords(10),
            'ten longest words' => $this->getLongestWords(10),
            'ten shortest words' => $this->getShortestWords(10),
            'ten longest sentences' => $this->getLongestSentences(10),
            'ten shortest sentences' => $this->getShortestSentences(10),
            'number of palindrome words' => $this->getNumberOfPalindromes(),
            'ten longest palindromes' => $this->getLongestPalindromes(10),
            'ten shortest palindromes' => $this->getShortestPalindromes(10),
            'is palindrome' => $this->isPalindrome() ? 'yes' : 'not',
            'generated at' => date("Y-m-d H:i:s"),
            'reversed text' => $this->getReversed(),
            'text in reversed order' => $this->getInReversedOrder(),
        ];

        $timeEnd = microtime(true);

        $executionTime = ($timeEnd - $timeStart) / 60;

        $result['executionTime'] = $executionTime;

        return $result;
    }
}