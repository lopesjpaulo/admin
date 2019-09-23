<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function maps()
    {
        return $this->hasMany(Map::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
