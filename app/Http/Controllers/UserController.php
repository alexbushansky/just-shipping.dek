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
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show',['user'=>$user]);
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

//    public function makeFile($file)
//    {
//        // создаем название файла
//        $filename = time() . '-' . str_random(4) . '.jpg';
//        // большой файл
//        // изменить размер изображения до ширины 1200 и ограничить пропорции (автоматическая высота)
//        Image::make($file)->resize(1200, null,function ($constraint) {
//
//            $constraint->aspectRatio();
//            // предотвратить увеличение
//            $constraint->upsize();
//        })->save( $this->fullWidthPath . $filename);
//
//        // миниатюра
//        //fit - поместиться
//        Image::make($file)->fit(495, 300, function ($constraint) {
//            $constraint->upsize();
//        })->save( $this->thumbnailsPath. $filename );
//        return $filename;
//
//    }

}
