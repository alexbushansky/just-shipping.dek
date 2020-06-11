<?php


namespace App\Repositories;


use App\Models\DialogMessage as Message;
use App\Repositories\Interfaces\DialogMessageRepoInterface;

class DialogMessageRepo implements DialogMessageRepoInterface
{
    public function createMessage(String $description,int $dialogId, int $userId)
    {
        $message = new Message();
        $message->message_text = $description;
        $message->dialog_id = $dialogId;
        $message->user_id = $userId;

        return $message->save();
    }
}
