<?php

namespace App\Models\Auth;

use App\Traits\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Models\Auth
 */
class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
     * @var array
     */
    public $searchableFields = ['name', 'email'];

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
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->count() > 0;
    }

    /**
     * @param array $roles
     * @return bool
     */
    public function hasAllRoles(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->count() == count($roles);
    }

    /**
     * @param string $role
     * @return void
     * @throws \Exception
     */
    public function attachRole(string $role): void
    {
        $role = Role::where('name', $role)->first();
        if (!$role) {
            throw new \Exception('Role does not exist');
        }

        $this->roles()->attach($role->id);
    }

    public function attachRoles(array $roles): void
    {
        $roles = Role::whereIn('name', $roles)->get();
        $this->roles()->attach($roles->pluck('id')->toArray());
    }


    /**
     * @param string $role
     * @return void
     * @throws \Exception
     */
    public function detachRole(string $role): void
    {
        $role = Role::where('name', $role)->first();
        if (!$role) {
            throw new \Exception('Role does not exist');
        }

        $this->roles()->detach($role->id);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
