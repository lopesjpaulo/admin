<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['data_inicio', 'data_final'];

    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }

    public function catorganizacao()
    {
        return $this->belongsTo(Catorganizacao::class);
    }
}
