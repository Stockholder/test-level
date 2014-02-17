<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('students', 'StudentsController');

Route::resource('affiliates', 'AffiliatesController');

Route::resource('languages', 'LanguagesController');

Route::resource('tests', 'TestsController');

Route::resource('questions', 'QuestionsController');

Route::resource('alternatives', 'AlternativesController');

Route::resource('audio', 'AudioController');

Route::get('questions/showByTest/{id}', function($id)
{
	$test =Test::find($id);
	$questions = $test->questions;
	return View::make('questions.index', compact('questions'));
});

Route::get('alternatives/showByQuestion/{id}', function($id)
{
	$question =Question::find($id);
	$alternatives = $question->alternatives;
	return View::make('alternatives.index', compact('alternatives'));
});

Route::post('alternatives/changeCorrect', function()
{
	$input = Input::all();
	DB::table('alternative_question')
            ->where('question_id', $input['question_id'])
            ->update(array('correct' => 0));

            DB::table('alternative_question')
            ->where('alternative_id', $input['alternative_id'])
            ->update(array('correct' => 1));
	return Response::json($input, 200);
});

Route::get('inicio', function()
{
	$languages = Language::all();
	$result = array();
	for ($i=0; $i < count($languages); $i++) { 
		$result['languages'][] = $languages[$i]->language;
	}

	$filiais = Affiliate::all();
	for ($i=0; $i < count($filiais); $i++) { 
		$result['affiliates'][] = $filiais[$i]->city;
	}
	return View::make('inicio.index')
		->with('languages', $result['languages'])
		->with('affiliates',$result['affiliates']);
});

Route::post('processando', 'ExameController@processing');
Route::get('exame', 'ExameController@exame');
Route::post('exame', 'ExameController@exame');
Route::get('fim', 'ExameController@fim');
Route::post('detectSession', 'ExameController@detectSession');
Route::post('uploadFile', 'QuestionsController@uploadFile');