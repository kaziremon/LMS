<?php

namespace App\Models;

use Mockery\Matcher\Subset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'exam_id',
        'subject_id',
        'chapter_id',
        'setquestion_id',
        'mark',
        'status',
      ];

      protected $guarded=['id'];

      public function exam()
      {
          return $this->belongsTo(Exam::class);
      }

      public function subject()
      {
          return $this->belongsTo(Subject::class);
      }
      public function chapter()
      {
          return $this->belongsTo(Chapter::class);
      }

      public function setquestion()
      {
          return $this->belongsTo(SetQuestion::class);
      }
}
