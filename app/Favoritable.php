<?php

namespace App;

trait Favoritable
{

	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	public function isFavorited()
	{
		return !! $this->favorites()->where('user_id', auth()->id())->count();
	}

	public function favorite()
	{
		 $attributes = ['user_id' => auth()->id()];

		 if(!$this->isFavorited())
		 {
		 	return $this->favorites()->create($attributes);
		 }
	}

	public function getFavoriteCountAttribute()
	{
		return $this->favorites()->count();
	}

	public function unFavorite()
	{
		if($this->isFavorited())
		{
			return $this->favorites()->where('user_id', auth()->id())->delete();
		}
	}

}