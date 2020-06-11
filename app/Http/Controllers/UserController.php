<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AvatarServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{


    private $avatarService;
    private $userRepository;


    public function __construct(AvatarServiceInterface $avatarService,UserRepositoryInterface $userRepository)
    {
        $this->avatarService = $avatarService;
        $this->userRepository = $userRepository;
        $this->middleware('check.user.cabinet',['only'=>['edit']]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {


     $protectUser = User::find($user->id);


            if ($user->hasRole('driver') && $protectUser->id  == auth()->user()->id) {

                if(isset($user->driver->driverCar)) {
                    $cars = $user->driver->driverCar;
                    return view('user.show', [
                        'user' => $user,
                        'cars' => $cars,
                    ]);
                }
                return view('user.show', [
                    'user' => $user,
                ]);
            }
            if($user->hasRole('customer') && $protectUser->id  == auth()->user()->id) {
                return view('user.show', [
                    'user' => $user,
                ]);
            }

            return abort(403);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('user.edit',['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        if ($this->userRepository->updateUser($request, $user)) {

            return redirect()->route('users.show', ['user' => auth()->user()->id])->with([
                'status' => 'Ваше профиль отредактирован успешно',
                'alert' => 'success',]);
        }

        return redirect()->route('users.show', ['user' => auth()->user()->id])->with([
            'status' => 'Ошибка редактирования',
            'alert' => 'error',]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function deleteAvatar(Request $request, User $user): RedirectResponse
    {

        if ($this->avatarService->deleteOldPicture($request->thumbnail)) {
            $user->thumbnail = null;
            if ($user->save()) {
                return redirect()->route('users.edit', ['user' => $user->id])->with([
                    'status' => 'Аватар удален успешно',
                    'alert' => 'success',]);
            }

            throw new \LogicException('Save error');
        }

        throw new \Exception('Failed to delete');

    }

    public function getGuestRoom($id)
    {

        $user = User::find($id);

        if($user->hasRole('customer'))
        {
            return view('user.user-customer-guest-page')->with(['user'=>$user]);
        }

        if($user->hasRole('driver'))
        {
            $cars = $user->driver->driverCar;
            return view('user.user-driver-guest-page')->with([
                'user'=>$user,
                'cars'=>$cars,
            ]);
        }

        return abort(403);
    }

}
