<?php


namespace App\Services;


use App\Repositories\Interfaces\DriverCarRepositoryInterface;
use App\Services\Interfaces\DriverCarServiceInterface;
use App\Services\Interfaces\FileServiceInterface;

class DriverCarService implements DriverCarServiceInterface
{

    private $driverCarRepository;
    private $fileService;

    public function __construct(DriverCarRepositoryInterface $driverCarRepository,FileServiceInterface $fileService)
    {
        $this->driverCarRepository=$driverCarRepository;
        $this->fileService = $fileService;
    }

    public function create($modelOfCar, $maxWeight, $internalLength, $internalHeight, $internalWidth, $maxCapacity, $thumbnail, $carType)
    {
        $user = auth()->user();

        if ($user->isDriver()) {
            $userDriverId = $user->driver->id;
            $thumbnail = $this->fileService->makeCarPhoto($thumbnail);
            if ($this->driverCarRepository->create($modelOfCar, $maxWeight, $internalLength,
                $internalHeight, $internalWidth, $maxCapacity, $userDriverId, $thumbnail, $carType)) {
                return true;
            } else {
                throw new \Exception('error');
            }
        }
        else
        {
            throw new \LogicException('error');
        }
    }
}
