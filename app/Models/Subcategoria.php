<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}