<?php

class Affiliate extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'city' => 'required'
	);
}
