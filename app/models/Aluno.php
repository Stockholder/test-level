<?php

class Aluno extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'nome' => 'required',
		'email' => 'required',
		'telefone' => 'required'
		);
}
