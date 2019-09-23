<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['signed_at'];
    protected $table = 'clients';

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function hostings()
    {
        return $this->hasMany('App\Models\Hosting');
    }
}