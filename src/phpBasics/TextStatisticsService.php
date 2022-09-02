<?php

namespace phpBasics;

class TextStatisticsService
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

        $result['execution time'] = $executionTime;

        return $result;
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