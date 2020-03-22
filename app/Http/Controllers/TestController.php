<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\DialogMessage as Message;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected  $nameSpace = '\\App\\Models\\';

    public function testSinc()
    {
        $user = \App\Models\User::find(5);
        $user->roles()->sync([]);
        dd($user->roles);

    }

    public function testDialog(Request $request)
    {

        $this->validate($request,[
            'description'=>'required|max:2000|min:5',
        ]);
        $type = $request->type;
        $nameSpace = $this->nameSpace . $type;
        $model = $nameSpace::find($request->offer_id);
        $dialog = new Dialog();
           $dialog->user_id = auth()->user()->id;
        $dialog->status_dialog_id = 1;
        $model->dialogs()->save($dialog);

        //получаем ид диалога и по ид диалога создаем сообщение в таблице messages
        // .user_id dialog_id created_at description

        $message = new Message();
        $message->message_text = $request->description;
        $message->dialog_id = $dialog->id;
        $message->user_id = $request->user()->id;
        $message->save();


        return response()->json([
           'success'=>true,
           'message'=>'Ваш отклик отправлен успешно'
        ]);

    }
}
