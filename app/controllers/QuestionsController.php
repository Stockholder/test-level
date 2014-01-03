<?php

class QuestionsController extends BaseController {

	/**
	 * Question Repository
	 *
	 * @var Question
	 */
	protected $question;

	public function __construct(Question $question)
	{
		$this->question = $question;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$questions = $this->question->all();

		return View::make('questions.index', compact('questions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('questions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Question::$rules);

		if ($validation->passes())
		{
			$this->question->create($input);

			return Redirect::route('questions.index');
		}

		return Redirect::route('questions.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$question = $this->question->findOrFail($id);

		return View::make('questions.show', compact('question'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$question = $this->question->find($id);

		if (is_null($question))
		{
			return Redirect::route('questions.index');
		}

		return View::make('questions.edit', compact('question'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Question::$rules);

		if ($validation->passes())
		{
			$question = $this->question->find($id);
			$question->update($input);

			return Redirect::route('questions.show', $id);
		}

		return Redirect::route('questions.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->question->find($id)->delete();

		return Redirect::route('questions.index');
	}

}
