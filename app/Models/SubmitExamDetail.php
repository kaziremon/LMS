<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmitExamDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'submitexam_id',
        'setquestion_id',
        'answer',
        'mark'
    ];
    protected $guarded=['id'];

    public function setquestion()
    {
        return $this->belongsTo(SetQuestion::class);
    }
    public function submitexam()
    {
        return $this->belongsTo(SubmitExam::class);
    }
}
