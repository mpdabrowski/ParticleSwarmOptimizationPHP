<?php

declare(strict_types=1);

namespace App\ParticleSwarmOptimizationPhp;

use Closure;

class Particle
{
    private Vector2D $personalBest;

    public function __construct(
        public Vector2D $position,
        public Vector2D $velocity,
        public Closure $fun,
        public float $weight,
        public float $c1,
        public float $c2
    ) {
        $this->personalBest = clone $position;
    }

    public function getPersonalBest(): Vector2D
    {
        return $this->personalBest;
    }

    public function getPersonalBestValue(): float
    {
        return ($this->fun)($this->personalBest);
    }

    public function update(Vector2D $globalBest): void
    {
        $this->updateVelocity($globalBest);
        $this->updatePosition();
    }

    private function updateVelocity(Vector2D $globalBest): void
    {
        //v[t+1] = w * v[t] + c1 * r1 * (pBest[t] — x[t]) + c2 * r2 * (gBest[t] — x[t])
        $this->velocity = $this->velocity
            ->multiplyByScalar($this->weight)
            ->add($this->personalBest->subtract($this->position)->multiplyByScalar($this->c1 * RandNumGenerator::get()))
            ->add($globalBest->subtract($this->position)->multiplyByScalar($this->c2 * RandNumGenerator::get()));
    }

    private function updatePosition(): void
    {
        $this->position = $this->position->add($this->velocity);
        if (($this->fun)($this->position) < ($this->fun)($this->personalBest)) {
            $this->personalBest = $this->position;
        }
    }
}
