<?php

class AlternativesController extends BaseController {

	/**
	 * Alternative Repository
	 *
	 * @var Alternative
	 */
	protected $alternative;

	public function __construct(Alternative $alternative)
	{
		$this->alternative = $alternative;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$alternatives = $this->alternative->all();

		return View::make('alternatives.index', compact('alternatives'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('alternatives.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Alternative::$rules);

		if ($validation->passes())
		{
			$question = Question::find($input['question_id']);
			unset($input['question_id']);
			$alternative = new Alternative($input);
			$question->alternatives()->save($alternative);
			return Response::json($input, 200);
		}
		$messages = $validation->errors()->toArray();
		return Response::json($messages, 400);
		// return Redirect::route('alternatives.create')
		// 	->withInput()
		// 	->withErrors($validation)
		// 	->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$alternative = $this->alternative->findOrFail($id);

		return View::make('alternatives.show', compact('alternative'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$alternative = $this->alternative->find($id);

		if (is_null($alternative))
		{
			return Redirect::route('alternatives.index');
		}

		return View::make('alternatives.edit', compact('alternative'));
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
		$validation = Validator::make($input, Alternative::$rules);

		if ($validation->passes())
		{
			$alternative = $this->alternative->find($id);
			$alternative->update($input);

			return Redirect::route('alternatives.show', $id);
		}

		return Redirect::route('alternatives.edit', $id)
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
		$this->alternative->find($id)->delete();

		return Redirect::route('alternatives.index');
	}

}
