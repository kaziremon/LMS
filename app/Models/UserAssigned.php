<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAssigned extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'batch_id',
        'course_id',
        'user_id',
    ];
    protected $guarded=['id'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
