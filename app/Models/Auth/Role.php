<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models\Auth
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'display_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
