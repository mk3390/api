<?php

namespace App;

use App\Followable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens , Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }
    public function timeline()
    {
        return $this->hasOne(Timeline::class);
    }
    public function block()
    {
        return $this->hasMany(Block::class);
    }

    public function loginActivity()
    {
        return $this->hasMany(loginActivity::class);
    }
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function privacy()
    {
        return $this->hasOne(Privacy::class);
    }
    public function statusGroup()
    {
        return $this->hasMany(StatusGroup::class);
    }
    public function notificationSetting()
    {
        return $this->hasOne(NotificationSetting::class);
    }
    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function timelinePost()
    {
        $users = $this->followings()->pluck('to_user_id');
        $users[]=  (auth()->check())?auth()->user()->id:0;
        return $posts = Post::whereIn('user_id',$users);
    }
    public function isBlock($user)
    {
        $block = Block::where('blocked_by',auth()->user()->id)->where('user_id',$user->id)->first();
        if($block){
            return true;
        }
        return false;
    }

}
