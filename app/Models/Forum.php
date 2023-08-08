<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
      'title','description','forumcategory_id','user_id',
    ];

    protected $guarded=['id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function forumcategory()
    {
      return $this->belongsTo(ForumCategory::class);
    }
    public function forumreply()
    {
        return $this->hasMany(ForumReply::class);
    }
}
