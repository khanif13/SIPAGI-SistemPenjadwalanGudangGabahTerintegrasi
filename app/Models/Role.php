<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Role extends Model
{
    protected $table = 'roles';

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
