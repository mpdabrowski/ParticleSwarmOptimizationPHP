<?php

declare(strict_types=1);

use App\ParticleSwarmOptimizationPhp\Vector2D;
use PHPUnit\Framework\TestCase;

class Vector2DTest extends TestCase
{
    public function testSubtract()
    {
        // Arrange
        $tuple1 = new Vector2D(5, 3);
        $tuple2 = new Vector2D(2, 1);
        $subtractedTuple = $tuple1->subtract($tuple2);

        // Assert & Act
        $this->assertEquals(3, $subtractedTuple->x);
        $this->assertEquals(2, $subtractedTuple->y);
    }

    public function testAdd()
    {
        // Arrange
        $tuple1 = new Vector2D(5, 3);
        $tuple2 = new Vector2D(2, 1);
        $addedTuple = $tuple1->add($tuple2);

        // Assert & Act
        $this->assertEquals(7, $addedTuple->x);
        $this->assertEquals(4, $addedTuple->y);
    }

    public function testMultiplyByScalar()
    {
        // Arrange
        $tuple = new Vector2D(5, 3);
        $scalar = 2;
        $tuple = $tuple->multiplyByScalar($scalar);

        // Assert & Act
        $this->assertEquals(10, $tuple->x);
        $this->assertEquals(6, $tuple->y);
    }
}
