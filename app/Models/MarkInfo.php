<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarkInfo extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'exam_id',
        'total_mark',
        'obtained_mark',
        'course_id',
        'batch_id',
        'user_id'

      ];

    protected $guarded=['id'];

    public function exam()
    {
      return $this->belongsTo(Exam::class);
    }

    public function course()
    {
      return $this->belongsTo(Course::class,'course_id','id');
    }
    public function batch()
    {
      return $this->belongsTo(Batch::class,'batch_id','id');
    }
    public function users()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }
}
