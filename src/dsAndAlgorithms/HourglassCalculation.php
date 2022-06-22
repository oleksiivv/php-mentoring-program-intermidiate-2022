<?php

namespace src\dsAndAlgorithms;

class HourglassCalculation
{
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

    public function getHourglassesSums(array $input): array
    {
        $hourglassesSum = [];

        for ($i = 0; $i < count($input)-2; $i++) {
            for ($j = 0; $j < count($input[$i])-2; $j++) {
                $hourglassesSum[$i][] = $this->countSingleHourglassSum($this->extractHourglassFromElement($input, $i, $j));
            }
        }

        return $hourglassesSum;
    }

    public function getMaxHourglassSum(array $input): int
    {
        return max(array_merge(...$this->getHourglassesSums($input)));
    }
}