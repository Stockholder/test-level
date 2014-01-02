<?php

class Language extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'language' => 'required'
	);

	public function test()
	{
		return hasMany('Test', 'language_id');
	}
}
