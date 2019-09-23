<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }
}
