<?php

require __DIR__ . '/vendor/autoload.php';

use App\ParticleSwarmOptimizationPhp\ParticleFactory;
use App\ParticleSwarmOptimizationPhp\ParticleSwarmOptimization;
use App\ParticleSwarmOptimizationPhp\Vector2D;

$f = fn(Vector2D $position): float => ($position->x - 3.14)**2
    + ($position->y - 2.72)**2
    + sin(3 * $position->x + 1.41)
    + sin(4 * $position->y - 1.73);
//
//        $f = fn(Vector2D $position): float => $position->x**2 + $position->y**2;

//$f = fn(Vector2D $position): float => ($position->x + 2 * $position->y - 7)**2 + (2 * $position->x + $position->y - 5)**2;


$optimizer = new ParticleSwarmOptimization(new ParticleFactory());
$optimizer->setOptimizedFunction($f);
$res = $optimizer->searchMin(0, 5, 0, 5);

var_dump($res->x, $res->y, $f($res));