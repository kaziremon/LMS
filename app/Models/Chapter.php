<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mockery\Matcher\Subset;

class Chapter extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'subject_id',
        'learning_outcome',
        'name',
        'user_id'
      ];

    protected $guarded=['id'];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function subject()
    {
      return $this->belongsTo(Subject::class);
    }
}
