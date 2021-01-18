<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;;

class User extends Authenticatable
{
    use  HasApiTokens , Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function timeline()
    {
        return $this->hasOne(Timeline::class);
    }

    public function follower()
    {
        return $this->hasMany(Follow::class, 'id', 'following_to');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'id', 'followed_by');
    }
}
