<?php

declare(strict_types=1);

use App\ParticleSwarmOptimizationPhp\Particle;
use App\ParticleSwarmOptimizationPhp\Vector2D;
use PHPUnit\Framework\TestCase;

class ParticleTest extends TestCase
{
    public function testUpdate()
    {
        // Arrange
        $randomNumGenerator = Mockery::mock('alias:App\ParticleSwarmOptimizationPhp\RandNumGenerator');
        $randomNumGenerator->shouldReceive('get')
            ->andReturn(0.5);

        $particle = new Particle(
            new Vector2D(0,0),
            new Vector2D(1,1),
            fn (Vector2D $v): float => $v->x**2 + $v->y**2,
            1,
            1,
            1
        );

        // Act
        $particle->update(new Vector2D(1,1));

        // Assert
        $this->assertEquals(new Vector2D(0, 0), $particle->getPersonalBest());
        $this->assertEquals(new Vector2D(1.5, 1.5), $particle->position);
    }
}
