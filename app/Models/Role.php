<?php

namespace App\Models;

use App\Models\User;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
      'description',
      'name',
      'slug',
      'delteable',
    ];
      protected $guarded=['id'];

      public function permissions()
      {
          return $this->belongsToMany(Permission::class);
      }

      public function users()
      {
          return $this->hasMany(User::class);
      }
      public function userassigned()
      {
        return $this->hasMany(UserAssigned::class);
      }
}
