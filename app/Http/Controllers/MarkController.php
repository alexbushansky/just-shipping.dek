<?php


namespace App\Http\Controllers;



use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{

    public function putMark(Request $request)
    {


        Mark::create([
            'order_id'=>$request->order_id,
            'user_id'=>$request->user_id,
            'type_id'=>$request->type_id,
            'mark'=>$request->raiting,
        ]);
        return redirect()->back()->with([
            'status' => 'Вы поставили оценку '. $request->raiting,
            'alert' => 'success',]);
    }

}
