<?php

namespace src\dsAndAlgorithms;

class HourglassCalculation
{
    private array $input;
    
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    private function countSingleHourglassSum(array $hourglass): int
    {
        $sum = 0;

        for ($i = 0; $i < count($hourglass); $i++) {
            for ($j = 0; $j < count($hourglass[$i]); $j++) {
                if ($i === 0 || $i === count($hourglass[$i]) - 1 || $i === $j) {
                    $sum += $hourglass[$i][$j];
                }
            }
        }

        return $sum;
    }

    private function extractHourglassFromElement(array $input, int $x, int $y): array
    {
        $hourglass = [];

        foreach ($input as $row) {
            $hourglass[] = array_slice($row, $y, 3);
        }

        return array_slice($hourglass, $x, 3);
    }

    public function getHourglassesSums(): array
    {
        $hourglassesSum = [];

        for ($i = 0; $i < count($this->input) - 2; $i++) {
            for ($j = 0; $j < count($this->input[$i]) - 2; $j++) {
                $hourglassesSum[$i][] = $this->countSingleHourglassSum($this->extractHourglassFromElement($this->input, $i, $j));
            }
        }

        return $hourglassesSum;
    }

    public function getMaxHourglassSum(): int
    {
        return max(array_merge(...$this->getHourglassesSums()));
    }
}