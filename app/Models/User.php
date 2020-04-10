<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    private const USER_CUSTOMER = 'customer';
    private const USER_DRIVER = 'driver';
    private const USER_ADMIN = 'admin';
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number','surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }


    public function isAdmin(): bool
    {

        foreach ($this->roles()->get() as $role) {
            if ($role->name == self::USER_ADMIN) {

                return true;
            }
        }

        return false;
    }

    public function isRole(string $roleName): bool
    {

        foreach ($this->roles()->get() as $role) {

            if ($role->name== $roleName) {
              return true;
            }

        }
        return false;
    }

    public function isCustomer(): bool
    {

        foreach ($this->roles()->get() as $role) {
            if ($role->name == self::USER_CUSTOMER) {

                return true;
            }
        }

        return false;
    }

    public function isDriver(): bool
    {

        foreach ($this->roles()->get() as $role) {
            if ($role->name == self::USER_DRIVER) {

                return true;
            }
        }

        return false;
    }






}
