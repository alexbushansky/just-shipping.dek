<?php


namespace App\Services\Interfaces;


use App\Models\User;

interface AvatarServiceInterface
{
    public function makeAvatar($file,User $user):string;
    public function deleteOldPicture($file):bool;
}
