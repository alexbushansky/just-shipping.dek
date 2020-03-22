<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\DialogMessage as Message;
use Illuminate\Http\Request;

class DialogController extends Controller
{

    protected  $nameSpace = '\\App\\Models\\';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Dialog $dialog)
    {
        $messages = $dialog->messages();


        return view('dialog.show',[
            'dialog'=>$dialog,
            'messages'=>$messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dialog $dialog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dialog $dialog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dialog $dialog)
    {
        //
    }
}
