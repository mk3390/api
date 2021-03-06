<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $data = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'comment', 'user_id', 'is_active', 'deleted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
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
