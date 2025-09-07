<?php

declare(strict_types=1);

namespace App\ParticleSwarmOptimizationPhp;

readonly class RandNumGenerator
{
    public static function get(): float
    {
        return mt_rand() / mt_getrandmax();
    }

    public static function getBetween(float $min, float $max): float
    {
        return $min + (mt_rand() / mt_getrandmax()) * ($max - $min);
    }
}
