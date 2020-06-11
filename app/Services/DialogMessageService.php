<?php


namespace App\Services;


use App\Repositories\Interfaces\DialogMessageRepoInterface;

class DialogMessageService
{
    private $dialogMessageRepo;
    public function __construct(DialogMessageRepoInterface $dialogMessageRepo)
    {
       $this->dialogMessageRepo =$dialogMessageRepo;

    }

    public function createMessage(String $description,int $dialogId, int $userId)
    {
        if(isset($description) && isset($dialogId) && isset($userId))
        {
            return $this->dialogMessageRepo->createMessage($description,$dialogId,$userId);
        }

        return false;

    }

}
