## ParticleSwarmOptimizationPHP

This is a simple **PSO (Particle Swarm Optimization)** implementation written in PHP 8.3.
Currently, it can only solve **2D minimization problems**.

### Example

```php
<?php

use App\ParticleSwarmOptimizationPhp\ParticleSwarmOptimization;
use App\ParticleSwarmOptimizationPhp\ParticleFactory;
use App\ParticleSwarmOptimizationPhp\Vector2D;

// Define the function to minimize
$f = fn(Vector2D $position): float => 
    ($position->x + 2 * $position->y - 7)**2 + 
    (2 * $position->x + $position->y - 5)**2;

// Create optimizer instance with a factory (or use dependency injection)
$optimizer = new ParticleSwarmOptimization(new ParticleFactory());

// Set the function to optimize
$optimizer->setOptimizedFunction($f);

// Search for the minimum in the given bounds
$result = $optimizer->searchMin(xMin: 0, xMax: 5, yMin: 0, yMax: 5);

echo "Optimized position: ({$result->x}, {$result->y})\n";
```

### Notes

* `searchMin` method **returns a `Vector2D` object** with the optimized coordinates.
* You can experiment with different 2D functions in `example.php`.
* Ensure your `Vector2D` class has public properties `x` and `y` and supports operations like addition and subtraction if used internally by the PSO implementation.
