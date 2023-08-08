<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmitExam extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'exam_id',
    ];
    protected $guarded=['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function submitexamdetail()
    {
        return $this->hasMany(SubmitExamDetail::class);
    }
}
