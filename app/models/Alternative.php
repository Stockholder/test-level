<?php

class Alternative extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'description' => 'required'
	);
}
