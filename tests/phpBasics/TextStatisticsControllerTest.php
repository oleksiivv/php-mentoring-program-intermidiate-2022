<?php

namespace Tests\phpBasics;

use PHPUnit\Framework\TestCase;
use phpBasics\TextStatisticsController;

class TextStatisticsControllerTest extends TestCase
{
    protected TextStatisticsController $textStatisticsController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->textStatisticsController = new TextStatisticsController();
    }

    public function testGetNumberOfCharactersWorksCorrectly()
    {
        $text = 'Hello world';
        $this->textStatisticsController->setText($text);

        $this->assertSame(mb_strlen($text), $this->textStatisticsController->getNumberOfCharacters());
    }

    public function testGetNumberOfWordsWorksCorrectly()
    {
        $text = 'Hello world! Some test txt 4';
        $this->textStatisticsController->setText($text);

        $numberOfWords = 6;

        $this->assertSame($numberOfWords, $this->textStatisticsController->getNumberOfWords());
    }

    public function testGetNumberOfSentencesWorksCorrectly()
    {
        $text = 'Sentence 1. Sentence 2! Sentence 3... Sentence 4?! Sentence 5.';
        $this->textStatisticsController->setText($text);

        $numberOfSentences = 5;

        $this->assertSame($numberOfSentences, $this->textStatisticsController->getNumberOfSentences());
    }

    public function testGetCharactersFrequencyWorksCorrectly()
    {
        $text = 'Test text';
        $frequency = [
            't' => 4,
            'e' => 2,
            's' => 1,
            'x' => 1,
            ' ' => 1,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertEquals($frequency, $this->textStatisticsController->getCharactersFrequency());
    }

    public function testGetCharactersDistributionAsPercentageOfTotalWorksCorrectly()
    {
        $text = 'Some text!';
        $frequency = [
            't' => 20,
            'e' => 20,
            's' => 10,
            'o' => 10,
            'm' => 10,
            'x' => 10,
            ' ' => 10,
            '!' => 10,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertEquals($frequency, $this->textStatisticsController->getCharactersDistributionAsPercentageOfTotal());
    }

    public function testGetAverageWordLengthWorksCorrectly()
    {
        $text = 'Some random new txt';
        $averageWordLength = 4;

        $this->textStatisticsController->setText($text);

        $this->assertSame($averageWordLength, $this->textStatisticsController->getAverageWordLength());
    }

    public function testGetAverageNumberOfWordsInSentenceWorksCorrectly()
    {
        $text = 'Sentence 1. Sentence number 2. Sentence sentence sentence 3!';
        $averageNumberOfWords = 3;

        $this->textStatisticsController->setText($text);

        $this->assertSame($averageNumberOfWords, $this->textStatisticsController->getAverageNumberOfWordsInSentence());
    }

    public function testGetMostUsedWordsWorksCorrectly()
    {
        $text = 'Lorem Ipsum is is simply dummy text text of the printing and typesetting industry word word word Lorem Ipsum text text';
        $topFiveWords = [
            'text' => 4,
            'word' => 3,
            'Lorem' => 2,
            'Ipsum' => 2,
            'is' => 2,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topFiveWords, $this->textStatisticsController->getMostUsedWords(5));
    }

    public function testGetLongestWordsWorksCorrectly()
    {
        $text = 'Lorem Ipsum is is simply dummy text text of the printing and typesetting industry word word word. Lorem Ipsum text text.';

        $topThreeWords = [
            'typesetting' => 11,
            'printing' => 8,
            'industry' => 8,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreeWords, $this->textStatisticsController->getLongestWords(3));
    }

    public function testGetShortestWordsWorksCorrectly()
    {
        $text = 'Lorem Ipsum is is simply dummy text text of printing and typesetting industry word word word. Lorem Ipsum text text.';

        $topThreeWords = [
            'is' => 2,
            'of' => 2,
            'and' => 3,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreeWords, $this->textStatisticsController->getShortestWords(3));
    }

    public function testGetLongestSentencesWorksCorrectly()
    {
        $text = 'Sentence number 1. Sentence number 2 with more words. Sentence. Longest sentence with some random text. Sentence n.';

        $topThreeSentences = [
            'Longest sentence with some random text.' => mb_strlen('Longest sentence with some random text.'),
            'Sentence number 2 with more words.' => mb_strlen('Sentence number 2 with more words.'),
            'Sentence number 1.' => mb_strlen('Sentence number 1.'),
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreeSentences, $this->textStatisticsController->getLongestSentences(3));
    }

    public function testGetShortestSentencesWorksCorrectly()
    {
        $text = 'Sentence number 1. Sentence number 2 with more words. Sentence. Longest sentence with some random text. Sentence n.';

        $topThreeSentences = [
            'Sentence.' => mb_strlen('Sentence.'),
            'Sentence n.' => mb_strlen('Sentence n.'),
            'Sentence number 1.' => mb_strlen('Sentence number 1.'),
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreeSentences, $this->textStatisticsController->getShortestSentences(3));
    }

    public function testGetNumberOfPalindromesWorksCorrectly()
    {
        $text = 'txt text test 121 889988';
        $numberOfPalindromes = 3;

        $this->textStatisticsController->setText($text);

        $this->assertSame($numberOfPalindromes, $this->textStatisticsController->getNumberOfPalindromes());
    }

    public function testGetLongestPalindromesWorksCorrectly()
    {
        $text = 'txt text test 121 o889988o level 35t53';
        $topThreePalindromes = [
            'o889988o' => 8,
            'level' => 5,
            '35t53' => 5,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreePalindromes, $this->textStatisticsController->getLongestPalindromes(3));
    }

    public function testGetShortestPalindromesWorksCorrectly()
    {
        $text = 'txt text test 1tt1 o889988o level 35t53 tt';
        $topThreePalindromes = [
            'tt' => 2,
            'txt' => 3,
            '1tt1' => 4,
        ];

        $this->textStatisticsController->setText($text);

        $this->assertSame($topThreePalindromes, $this->textStatisticsController->getShortestPalindromes(3));
    }

    public function testIsPalindromeWorksCorrectly()
    {
        $palindrome = 'Draw, O coward!';
        $nonPalindrome = 'Some random text!';

        $this->textStatisticsController->setText($palindrome);
        $this->assertTrue($this->textStatisticsController->isPalindrome());

        $this->textStatisticsController->setText($nonPalindrome);
        $this->assertFalse($this->textStatisticsController->isPalindrome());
    }

    public function testGetReversedWorksCorrectly()
    {
        $text = 'Hello world';
        $reversed = 'dlrow olleH';

        $this->textStatisticsController->setText($text);

        $this->assertSame($reversed, $this->textStatisticsController->getReversed());
    }

    public function testGetInReversedOrderWorksCorrectly()
    {
        $text = 'Hello world!';
        $inReversedOrder = '!world Hello';

        $this->textStatisticsController->setText($text);

        $this->assertSame($inReversedOrder, $this->textStatisticsController->getInReversedOrder());
    }
}