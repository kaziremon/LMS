<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'course_id'
      ];
      public function course()
      {
          return $this->belongsTo(Course::class);
      }
      public function user()
      {
          return $this->belongsTo(User::class);
      }
      public function userassigned()
      {
        return $this->hasMany(UserAssigned::class);
      }
      public function marksheets()
      {
        return $this->belongsTo(Marksheet::class,'batch_id','id');
      }
}
