<?php

namespace App\Http\Controllers;

use App\Models\DialogMessage;
use Illuminate\Http\Request;

class DialogMessageController extends Controller
{


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message_text'=>'required|max:2000|min:1',
        ]);


        $message = new DialogMessage();

        $message->message_text= wordwrap($request->message_text, 50, "\n", true);
        $message->dialog_id = $request->dialog_id;
        $message->user_id = $request->user()->id;
        $message->save();
        return redirect()->route('dialogs.show',[
            'dialog'=>$request->dialog_id,
        ])->with([
            'status'=>'Ваше сообщение отправлено успешно',
            'alert'=>'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function show(DialogMessage $dialogMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(DialogMessage $dialogMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DialogMessage $dialogMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DialogMessage $dialogMessage)
    {
        //
    }
}
