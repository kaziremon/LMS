<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
      ];

      public function batch()
      {
          return $this->hasMany(Batch::class);
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
      return $this->belongsTo(Marksheet::class,'course_id','id');
    }
}
