<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Driver;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AvatarServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{
    private $avatarService;

    public function __construct(AvatarServiceInterface $avatarService)
    {
       $this->avatarService=$avatarService;
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data):User
    {

        $user = User::create([
            'name' => $data['name'],
            'surname' =>$data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone'],

        ]);


        $user->roles()->sync([$data['role_id']]);

        if ($user->isCustomer()) {
            Customer::create([
                'user_id' => $user->id
            ]);
        } else if ($user->isDriver()) {
            Driver::create([
                'user_id' => $user->id
            ]);
        } else {
            $user->delete();
            throw new \RuntimeException('don`t find role');
        }

        return $user;
    }

    public function updateUser(Request $request, User $user):bool
    {
        if ($request->hasFile('photo')) {
            // проверяем существование дирректорий для изображений
            // если нет , то создаем дирректории
            $user->thumbnail = $this->avatarService->makeAvatar($request->file('photo'),$user);
        }

        if($request->password)
        {
            $user->password = Hash::make($request->password);
        }
        if($request->email)
        {
            $user->email= $request->email;
        }
        if($request->phone)
        {
            $user->phone_number= $request->phone;
        }

        if($request->name)
        {
            $user->name= $request->name;
        }


            if($user->save()) {
                return true;
            }

        return false;
    }
}
