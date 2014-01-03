<?php

class Question extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'description' => 'required',
		'audio_id' => 'required'
	);
}
