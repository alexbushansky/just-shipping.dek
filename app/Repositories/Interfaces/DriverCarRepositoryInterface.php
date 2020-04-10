<?php


namespace App\Repositories\Interfaces;


interface DriverCarRepositoryInterface
{
        public function create($modelOfCar, $maxWeight, $internalLength,$internalHeight,$internalWidth,$maxCapacity,$driverId,$thumbnail,$carType);
}
