<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'question_id',
        'chapter_id',
        'subject_id',
        'user_id',
        'question',
        'mark',
        'rubric',
        'draft',
        'status',
        'defficult_level',
    ];
    protected $guarded=['id'];


    public function question()
    {
        return $this->belongsTo(Question::class,'question_id','id');
    }
    public function questionmcq()
    {
        return $this->hasMany(QuestionMcq::class);
    }

    public function questionanswer()
    {
        return $this->hasMany(QuestionAnswer::class);
    }
}
