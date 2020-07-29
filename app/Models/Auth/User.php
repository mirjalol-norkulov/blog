<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models\Auth
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * @param string $role
     * @return void
     */
    public function attachRole(string $role): void
    {
        $role = Role::where('name', $role)->first();
        if (!$role) {
            throw new \Exception('Role does not exists');
        }

        $this->roles()->attach($role->id);
    }


    /**
     * @param string $role
     * @return void
     */
    public function detachRole(string $role): void
    {
        $role = Role::where('name', $role)->first();
        if (!$role) {
            throw new \Exception('Role does not exists');
        }

        $this->roles()->detach($role->id);
    }
}
