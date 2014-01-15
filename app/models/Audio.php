<?php

class Audio extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	
	public function Questao()
	{
		return $this->hasOne('Questao');
	}
}
