<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    private $userRepository;
        public function __construct(UserRepositoryInterface $userRepository)
        {
            $this->userRepository=$userRepository;
        }

    public function createUser(array $array): User
    {

       return $this->userRepository->createUser($array);
    }

}
