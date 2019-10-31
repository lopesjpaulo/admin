<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacao extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'create_at', 'updated_at', 'deleted_at'];

    public function catorganizacoes()
    {
        return $this->hasMany(Catorganizacao::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_organizations');
    }
}