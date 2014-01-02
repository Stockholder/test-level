<?php

class Test extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'description' => 'required',
		'languages_id' => 'required',
		'affiliates_id' => 'required'
	);

	public function language()
	{
		return $this->belongsTo('Language');
	}

	public function affiliate()
	{
		return $this->belongsTo('Affiliate');
	}
}
