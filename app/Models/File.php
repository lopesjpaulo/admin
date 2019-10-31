<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'files_tags');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_files');
    }
}