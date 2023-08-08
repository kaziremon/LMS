<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumReply extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
      'comment','forum_id','user_id',
    ];

    protected $guarded=['id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function forum()
    {
      return $this->belongsTo(Forum::class);
    }
}
