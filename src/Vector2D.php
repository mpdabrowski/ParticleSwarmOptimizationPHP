<?php

declare(strict_types=1);

namespace App\ParticleSwarmOptimizationPhp;

readonly class Vector2D
{
    public function __construct(
      public float $x,
      public float $y
    ) {
    }

    public function subtract(Vector2D $subtrahend): self
    {
        return new self($this->x - $subtrahend->x, $this->y - $subtrahend->y);
    }

    public function add(Vector2D $addend): self
    {
        return new self($this->x + $addend->x, $this->y + $addend->y);
    }

    public function multiplyByScalar(float $scalar): self
    {
        return new self($scalar * $this->x, $scalar * $this->y);
    }
}
