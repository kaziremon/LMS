<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id',
    ];
    protected $guarded=['id'];

    public function chapter(){
        return $this->hasMany(Chapter::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
