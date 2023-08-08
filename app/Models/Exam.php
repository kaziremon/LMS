<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'exam_title',
        'course_id', // Course Model
        'user_id',
        'batch_id', // Batch Model
        'start_time',
        'end_time',
        'date',
        'status',
        'mark_publish'
      ];

    protected $guarded=['id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function batch()
    {
      return $this->belongsTo(Batch::class);
    }
    public function course()
    {
      return $this->belongsTo(Course::class);
    }
    public function examsubmit()
    {
        return $this->hasMany(SubmitExam::class);
    }
    public function marksheets()
    {
      return $this->belongsTo(Marksheet::class);
    }
    public function examquestion()
    {
        return $this->hasMany(ExamQuestion::class);
    }
}
