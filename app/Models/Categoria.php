<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}