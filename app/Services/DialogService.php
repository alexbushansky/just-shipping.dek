<?php


namespace App\Services;


use App\Events\TestEvent;
use App\Http\Requests\DialogRequest;
use App\Models\Dialog;
use App\Repositories\Interfaces\DialogMessageRepoInterface;
use App\Repositories\Interfaces\DialogRepositoryInterface;
use App\Services\Interfaces\DialogServiceInterface;
use Illuminate\Http\Request;

class DialogService implements DialogServiceInterface
{
    private const NAME_SPACE = '\\App\\Models\\';
    private $dialogRepository;
    private $dialogMessageService;
    public function __construct(DialogRepositoryInterface $dialogRepository,
                                    DialogMessageRepoInterface $dialogMessageService)
    {
        $this->dialogRepository = $dialogRepository;
        $this->dialogMessageService = $dialogMessageService;
    }

    public function storeDialog(DialogRequest $request)
    {
        $userId = auth()->user()->id;
        if (policy(Dialog::class)->create($userId, $request->offer_id)) {
            $type = $request->type;
            $nameSpace = self::NAME_SPACE . $type;
            $model = $nameSpace::find($request->offer_id);


            if ($type == 'DriverOffer') {
                if (!isset($request->customer_offer_id)) {
                    return response()->json([
                        'error' => false,
                        'message' => 'Укажите объявление!'
                    ]);
                }
            }

            $dialog = $this->dialogRepository->create($userId, (int)$request->customer_offer_id,
                $type, (int)$request->offer_id, $model);

            if ($this->dialogMessageService->createMessage($request->description, $dialog->id,
                $request->user()->id)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ваш отклик отправлен успешно'
                ]);
            }
        } else {
            return response()->json([
                'error' => false,
                'message' => 'Вы уже отправляли отклик!'
            ]);
        }
    }

    public function getAllDialogs()
    {
        $user = auth()->user();

        if($user->hasRole('customer')) {
            return $this->dialogRepository->showCustomerDialogs($user->id);
        }else if($user->hasRole('driver'))
        {

            return $this->dialogRepository->showDriverDialogs($user->id);
        }
    }

    public function getOffersDialogs()
    {
        $user = auth()->user();
        return $this->dialogRepository->showOffersDialog($user->id);
    }
    public function changeStatusDialogCustomerOffer($id)
    {

    }
}
