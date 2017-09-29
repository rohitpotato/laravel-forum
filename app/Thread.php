<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	use RecordsActivity;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($thread) {

            $thread->replies->each->delete();
        });
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(channel::class);
    }

    public function subscribe()
    {
        return $this->hasMany(Subscribe::class);
    }

    public function is_subscribed()
    {
        return !! $this->subscribe()->where('user_id', auth()->id())->count();
    }
}
