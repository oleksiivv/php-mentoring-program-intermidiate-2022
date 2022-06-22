<?php

namespace src\dsAndAlgorithms;

class ArrayRotation
{
    public function perform(array $array, int $steps): array
    {
        $first  = array_slice($array, 0, $steps);
        $second = array_slice($array, $steps, null);

        return array_merge( $second, $first );
    }
}