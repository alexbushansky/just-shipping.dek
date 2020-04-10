<?php


namespace App\Services;


use App\Repositories\Interfaces\DialogRepositoryInterface;
use App\Services\Interfaces\DialogServiceInterface;

class DialogService implements DialogServiceInterface
{
    private $dialogRepository;
    public function __construct(DialogRepositoryInterface $dialogRepository)
    {
        $this->dialogRepository = $dialogRepository;
    }

    public function getAllDialogs()
    {
        $user = auth()->user();

        if($user->hasRole('customer')) {
            return $this->dialogRepository->showCustomerDialogs($user->id);
        }else if($user->hasRole('driver'))
        {

            return $this->dialogRepository->showDriverDialogs($user->id);
        }
    }

    public function getOffersDialogs()
    {
        $user = auth()->user();
        return $this->dialogRepository->showOffersDialog($user->id);
    }
}
