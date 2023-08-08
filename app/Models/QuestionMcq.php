<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionMcq extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'setquestion_id',
        'option',
    ];
    protected $guarded=['id'];

    public function setquestion()
    {
        return $this->belongsTo(SetQuestion::class);
    }

    public function questionanswer()
    {
        return $this->hasMany(QuestionAnswer::class,'answer','id');
    }
}
