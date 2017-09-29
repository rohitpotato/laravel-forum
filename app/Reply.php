<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($reply) {

            $reply->favorites->each->delete();
        });
    }

    protected function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }
}
