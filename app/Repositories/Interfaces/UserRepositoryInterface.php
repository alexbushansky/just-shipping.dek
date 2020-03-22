<?php


namespace App\Repositories\Interfaces;




use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
        public function createUser(array $array):User;
        public function updateUser(Request $request, User $user):bool;
}
