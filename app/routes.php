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

Route::get('questions/showByTest/{id}', function($id)
{
	$test =Test::find($id);
	$questions = $test->questions;
	return View::make('questions.index', compact('questions'));
});