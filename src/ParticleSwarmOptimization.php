<?php

declare(strict_types=1);

namespace App\ParticleSwarmOptimizationPhp;

use Closure;

class ParticleSwarmOptimization
{
    private Closure $optimizedFunction;
    private Vector2D $globalBest;

    public function __construct(
        private readonly ParticleFactory $particleFactory
    ) {
    }

    /**
     * @param Closure(Vector2D): float $optimizedFunction
     */
    public function setOptimizedFunction(Closure $optimizedFunction): void
    {
        $this->optimizedFunction = $optimizedFunction;
    }

    public function searchMin(
        float $xMin,
        float $xMax,
        float $yMin,
        float $yMax,
        int $numOfParticles = 40,
        int $epochs = 1000,
        float $weight = 0.8,
        float $c1 = 2,
        float $c2 = 2
    ): Vector2D {
        $this->globalBest = new Vector2D($xMin,$yMin);
        $particles = $this->initializeParticles(
            numOfParticles: $numOfParticles,
            xMin: $xMin,
            xMax: $xMax,
            yMin: $yMin,
            yMax: $yMax,
            weight: $weight,
            c1: $c1,
            c2: $c2
        );

        $this->findGlobalBest($epochs, $particles);

        return $this->globalBest;
    }

    /** @return Particle[] */
    private function initializeParticles(
        int $numOfParticles,
        float $xMin,
        float $xMax,
        float $yMin,
        float $yMax,
        float $weight,
        float $c1,
        float $c2
    ): array {
        $particles = [];
        for ($i = 0; $i < $numOfParticles; $i++) {
            $particle = $this->particleFactory->create(
                optimizedFunction: $this->optimizedFunction,
                xMin: $xMin,
                xMax: $xMax,
                yMin: $yMin,
                yMax: $yMax,
                weight: $weight,
                c1: $c1,
                c2: $c2
            );
            $this->setGlobalBest($particle);
            $particles[] = $particle;
        }

        return $particles;
    }

    private function findGlobalBest(int $epochs, array $particles): void
    {
        for ($i = 0; $i < $epochs; $i++) {
            /** @var Particle $particle */
            foreach ($particles as $particle) {
                $particle->update($this->globalBest);
                $this->setGlobalBest($particle);
            }
        }
    }

    private function setGlobalBest(Particle $particle): void
    {
        if ($particle->getPersonalBestValue() < ($this->optimizedFunction)($this->globalBest)) {
            $this->globalBest = $particle->getPersonalBest();
        }
    }
}
