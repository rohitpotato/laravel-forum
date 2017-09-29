<?php

namespace App;

trait RecordsActivity
{
	public static function bootRecordsActivity()
	{
		if (auth()->guest()) return;

		foreach(static::getActivitiesToRecord() as $event)
		{
			static::$event( function ($model) use ($event) {

				$model->recordActivity($event);
			});
		}

		static::deleting(function ($model){

			$model->activities()->delete();
		});
	}

	public function recordActivity($event)
	{
		return $this->activities()->create(['user_id' => auth()->id(), 'type' => $this->getActivityType($event)]);
	}

	public static function getActivitiesToRecord()
	{
		return ['created'];
	}

	public function activities()
	{
		return $this->morphMany(Activity::class, 'subject');
	}

	public function getActivityType($event)
	{
		$type = strtolower((new \ReflectionClass($this))->getShortName());
		return "{$event}_{$type}";
	}

	
}