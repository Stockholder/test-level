<?php

class Question extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'description' => 'required',
		'path' => 'required'
	);

	public function alternatives()
	{
		return $this->belongsToMany('Alternative', 'alternative_question');
	}
	
	public function tests()
	{
		return $this->belongsToMany('Test', 'question_test');
	}

}
