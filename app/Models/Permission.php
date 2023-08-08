<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
    ];
      protected $guarded=['id'];

      public function module()
      {
        return  $this->belongsTo(Module::class);
      }

      public function roles()
      {
          return $this->belongsToMany(Role::class);
      }
}
