<?php

namespace App\Http\Controllers;

use App\Events\DialogMessage;
use App\Events\TestEvent;
use App\Models\CustomerOffer;
use App\Models\Dialog;
use App\Models\DialogMessage as Message;
use App\Models\DriverOffer;
use App\Services\Interfaces\DialogServiceInterface;
use Illuminate\Http\Request;
use function Sodium\increment;

class DialogController extends Controller
{

    protected  $nameSpace = '\\App\\Models\\';
    private $dialogService;

    public function __construct(DialogServiceInterface $dialogService)
    {
        $this->dialogService = $dialogService;
    }

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
        //dd($request);

        $this->validate($request,[
            'description'=>'required|max:2000|min:5',
        ]);

        $userId = auth()->user()->id;

        if(policy(Dialog::class)->create($userId,$request->offer_id)) {

            $type = $request->type;
            $nameSpace = $this->nameSpace . $type;
            $model = $nameSpace::find($request->offer_id);

            $dialog = new Dialog();
            $dialog->user_id = $userId;
            $dialog->status_dialog_id = 1;
            if ($type == 'CustomerOffer')
                $dialog->recipient_id = CustomerOffer::find($request->offer_id)->customer->user->id;
            else {
                $dialog->recipient_id = DriverOffer::find($request->offer_id)->driver->user->id;
            }
            if ($request->customer_offer_id) {
                $dialog->customer_offer_id = $request->customer_offer_id;
            }
            $model->dialogs()->save($dialog);

            if ($type == 'DriverOffer') {
                $driverCustomer = $model->driver->user;
                event(new TestEvent($driverCustomer, $dialog));
            } else {
                $userCustomer = $model->customer->user;
                event(new TestEvent($userCustomer, $dialog));
            }

            //  Добавляем получателю счетчик новых сообщений
            $dialog->increment('recipient_new', 1);


            //получаем ид диалога и по ид диалога создаем сообщение в таблице messages
            // .user_id dialog_id created_at description

            $message = new Message();
            $message->message_text = $request->description;
            $message->dialog_id = $dialog->id;
            $message->user_id = $request->user()->id;

            $message->save();


            return response()->json([
                'success' => true,
                'message' => 'Ваш отклик отправлен успешно'
            ]);
        }else
        {
            return response()->json([
                'error' => false,
                'message' => 'Вы уже отправляли отклик!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Dialog $dialog)
    {

        if(policy(Dialog::class)->show($dialog)) {
            $customerOffer = null;

            if ($dialog->customer_offer_id) {

                $customerOffer = CustomerOffer::with('cargoType')
                                        ->find($dialog->customer_offer_id);


            }
            $messages = Message::where('dialog_id','=',$dialog->id)
                                ->with('user')
                                ->get();







            return view('dialog.show', [
                'dialog' => $dialog,
                'messages'=>$messages,
                'customerOffer' => $customerOffer,
            ]);
        }

        abort(403);
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

    public function showAllUsersDialogs()
    {
       $offers = $this->dialogService->getAllDialogs();

       return view('offers.yourOffer')->with(
           ['offers' => $offers]
       );
    }
    public function showAllOffersForYou()
    {
        $offers = $this->dialogService->getOffersDialogs();

        return view('offers.offersForYou')->with(
            ['offers' => $offers]
        );
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
