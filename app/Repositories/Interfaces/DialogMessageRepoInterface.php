<?php


namespace App\Repositories\Interfaces;


interface DialogMessageRepoInterface
{
    public function createMessage(String $description,int $dialogId, int $userId);
}
