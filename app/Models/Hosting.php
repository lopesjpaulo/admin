<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hosting extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['signed_at', 'expired_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}