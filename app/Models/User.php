<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'batch_id',
        'course_id',
        'teacher_id',
        'student_id',
        'full_name',
        'profile_pic',
        'is_active',
    ];
    protected $guarded=['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function hasPermission($permission) : bool
    {
        return $this->role->permissions()->where('slug',$permission)->first() ? true : false;
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function marksheets()
    {
      return $this->belongsTo(Marksheet::class,'user_id','id');
    }
}
