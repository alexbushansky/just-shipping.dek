<?php


namespace App\Services;


use App\Repositories\Interfaces\DriverOfferRepositoryInterface;
use App\Services\Interfaces\DriverOfferServiceInterface;
use Illuminate\Http\Request;

class DriverOfferService implements DriverOfferServiceInterface
{
    private $driverRepository;

    public function __construct(DriverOfferRepositoryInterface $driverRepository)
    {
        $this->driverRepository= $driverRepository;
    }

    public function changeStatus($id)
    {

        if($id>0 && is_numeric($id) && isset($id)) {
            $this->driverRepository->acceptedOffer($id);
        }
    }

    public function createOffer(Request $request)
    {
        return $this->driverRepository->createOffer($request);
    }
    public function deleteDriverOffer(int $id)
    {
        $this->driverRepository->deleteDriverOffer($id);
    }

}
