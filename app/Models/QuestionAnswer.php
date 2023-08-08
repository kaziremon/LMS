<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionAnswer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'setquestion_id',
        'answer',
    ];
    protected $guarded=['id'];

    public function setquestion()
    {
        return $this->belongsTo(SetQuestion::class);
    }

    public function questionmcq()
    {
        return $this->belongsTo(QuestionMcq::class,'id','answer');
    }
}
