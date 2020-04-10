<?php


namespace App\Services\Interfaces;


interface DriverCarServiceInterface
{
    public function create($modelOfCar, $maxWeight, $internalLength,$internalHeight,
                           $internalWidth,$maxCapacity,$thumbnail,$carType);
}
