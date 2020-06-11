<?php

namespace App\Http\Controllers;

use App\Events\DialogMessage;
use App\Events\TestEvent;
use App\Http\Requests\DialogRequest;
use App\Models\CustomerOffer;
use App\Models\Dialog;
use App\Models\DialogMessage as Message;
use App\Models\DriverOffer;
use App\Services\Interfaces\DialogServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Sodium\increment;

class DialogController extends Controller
{


    private $dialogService;

    public function __construct(DialogServiceInterface $dialogService)
    {
        $this->dialogService = $dialogService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param DialogRequest $request
     * @return JsonResponse
     */
    public function store(DialogRequest $request): JsonResponse
    {

        return $this->dialogService->storeDialog($request);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Dialog $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Dialog $dialog)
    {

        if (policy(Dialog::class)->show($dialog)) {
            $customerOffer = null;

            if ($dialog->customer_offer_id) {

                $customerOffer = CustomerOffer::with('cargoType')
                    ->find($dialog->customer_offer_id);


            }
            $messages = Message::where('dialog_id', '=', $dialog->id)
                ->with('user')
                ->get();

            return view('dialog.show', [
                'dialog' => $dialog,
                'messages' => $messages,
                'customerOffer' => $customerOffer,
            ]);
        }

        abort(403);
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

}
