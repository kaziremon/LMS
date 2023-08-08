<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'questiontype_id',
        'chapter_id',
        'user_id',
        'is_bank',
    ];

    protected $guarded=['id'];

    public function questiontype()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function setquestion()
    {
        return $this->hasMany(SetQuestion::class,'question_id','id');
    }
}
