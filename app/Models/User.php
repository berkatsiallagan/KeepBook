<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['username', 'password', 'nama', 'role'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = md5($user->password);
        });

        static::updating(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = md5($user->password);
            }
        });
    }
}