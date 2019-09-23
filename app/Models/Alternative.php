<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternative extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function deleteMany($question_id){
        $alternatives = Alternative::where('question_id', '=', $question_id)->delete();
        return $alternatives;
    }
}
