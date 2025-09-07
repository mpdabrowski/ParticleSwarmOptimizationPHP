<?php

declare(strict_types=1);

namespace App\ParticleSwarmOptimizationPhp;

use Closure;

class ParticleFactory
{
    public function create(
        Closure $optimizedFunction,
        float $xMin,
        float $xMax,
        float $yMin,
        float $yMax,
        float $weight,
        float $c1,
        float $c2
    ): Particle {
        return new Particle(
            new Vector2D(
                RandNumGenerator::getBetween($xMin, $xMax),
                RandNumGenerator::getBetween($yMin, $yMax)
            ),
            new Vector2D(
                RandNumGenerator::getBetween($xMin, $xMax) * 0.1,
                RandNumGenerator::getBetween($yMin, $yMax) * 0.1
            ),
            $optimizedFunction,
            $weight,
            $c1,
            $c2
        );
    }
}
