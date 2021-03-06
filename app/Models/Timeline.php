<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'timeline';
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getAllPost()
    {
        return $this->posts->with('comment');
    }
}
