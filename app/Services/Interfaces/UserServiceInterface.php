<?php


namespace App\Services\Interfaces;


use App\Models\User;

interface UserServiceInterface
{
        public function createUser(array $array):User;
}
