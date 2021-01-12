<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $data = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'timeline_id', 'user_id', 'post', 'type', 'is_active', 'post_id', 'is_repost', 'is_draft', 'deleted'];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validate($request)
    {
        $this->data = $request->all();
    }

    public function store()
    {
        $this->create($this->data);
    }
}
