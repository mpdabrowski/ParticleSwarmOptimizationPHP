<?php

declare(strict_types=1);

use App\ParticleSwarmOptimizationPhp\ParticleFactory;
use App\ParticleSwarmOptimizationPhp\ParticleSwarmOptimization;
use App\ParticleSwarmOptimizationPhp\Vector2D;
use PHPUnit\Framework\TestCase;

class ParticleSwarmOptimizationTest extends TestCase
{
    public function testSearchMin(): void
    {
        // Arrange
        $randomNumGenerator = Mockery::mock('alias:App\ParticleSwarmOptimizationPhp\RandNumGenerator');
        $randomNumGenerator->shouldReceive('get')
            ->andReturn(0.5);
        $randomNumGenerator->shouldReceive('getBetween')
            ->andReturn(1);
        $particleSwarmOptimization = new ParticleSwarmOptimization(
            new ParticleFactory()
        );

        $particleSwarmOptimization->setOptimizedFunction(
            fn(Vector2D $position): float => $position->x**2 + $position->y**2
        );

        // Act
        $result = $particleSwarmOptimization->searchMin(-5, 5, -5, 5);

        // Assert
        $this->assertEquals(0, round($result->x));
        $this->assertEquals(0, round($result->y));
    }
}
