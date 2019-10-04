<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
