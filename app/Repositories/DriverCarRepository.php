<?php


namespace App\Repositories;


use App\Models\DriverCar;
use App\Repositories\Interfaces\DriverCarRepositoryInterface;


class DriverCarRepository implements DriverCarRepositoryInterface
{
    private $driverCar;

    public function __construct(DriverCar $driverCar)
    {
        $this->driverCar = $driverCar;
    }


    public function create($modelOfCar, $maxWeight, $internalLength,$internalHeight,$internalWidth,$maxCapacity,$driverId,$thumbnail,$carType)
    {
        $this->driverCar->model_of_car = $modelOfCar;
        $this->driverCar->max_weight = $maxWeight;
        $this->driverCar->internal_length = $internalLength;
        $this->driverCar->internal_height = $internalHeight;
        $this->driverCar->internal_width = $internalWidth;
        $this->driverCar->max_capacity = $maxCapacity;
        $this->driverCar->driver_id = $driverId;
        $this->driverCar->thumbnail = $thumbnail;
        $this->driverCar->type_of_car = $carType;
        if ($this->driverCar->save())
        {
            return true;
        }

        return false;

    }
}
