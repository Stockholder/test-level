<?php

class Alternative extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'description' => 'required'
	);

    public function questions()
    {
        return $this->belongsToMany('Question', 'alternative_question');
    }
}
