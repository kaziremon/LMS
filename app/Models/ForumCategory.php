<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
      'name','slug',
    ];

    protected $guarded=['id'];


    public function forum()
    {
        return $this->hasMany(Forum::class);
    }
}
