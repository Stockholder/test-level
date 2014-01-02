<?php

class TestsController extends BaseController {

	/**
	 * Test Repository
	 *
	 * @var Test
	 */
	protected $test;

	public function __construct(Test $test)
	{
		$this->test = $test;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = $this->test->all();

		return View::make('tests.index', compact('tests'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//refatorar
		$languages = Language::get();

		$languages_options = array();
		
		$languages_options[''] = 'Selecione uma lingua';

		foreach ($languages as $language)
		{
		     $languages_options[$language->id] = $language->language;
		}

		$affiliates = Affiliate::get();

		$affiliates_options = array();

		$affiliates_options[''] = 'Selecione uma filial';
		
		foreach ($affiliates as $affiliate)
		{
		     $affiliates_options[$affiliate->id] = $affiliate->city;
		}

		return View::make('tests.create', array('affiliates_options' => $affiliates_options, 'languages_options' => $languages_options));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		if(!isset($input['active']))
			$input['active'] =  0; 
		$validation = Validator::make($input, Test::$rules);

		if ($validation->passes())
		{
			$this->test->create($input);

			return Redirect::route('tests.index');
		}

		return Redirect::route('tests.create')
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
		$test = $this->test->findOrFail($id);

		return View::make('tests.show', compact('test'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//refatorar
		$languages = Language::get();

		$languages_options = array();

		$languages_options[''] = 'Selecione uma lingua';

		foreach ($languages as $language)
		{
		     $languages_options[$language->id] = $language->language;
		}

		$affiliates = Affiliate::get();

		$affiliates_options = array();

		$affiliates_options[''] = 'Selecione uma filial';

		foreach ($affiliates as $affiliate)
		{
		     $affiliates_options[$affiliate->id] = $affiliate->city;
		}

		$test = $this->test->find($id);

		if (is_null($test))
		{
			return Redirect::route('tests.index');
		}

		return View::make('tests.edit', array('test' => $test, 'affiliates_options' => $affiliates_options, 'languages_options' => $languages_options));
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
		if(!isset($input['active']))
			$input['active'] =  0; 
		$validation = Validator::make($input, Test::$rules);

		if ($validation->passes())
		{
			$test = $this->test->find($id);
			$test->update($input);

			return Redirect::route('tests.show', $id);
		}

		return Redirect::route('tests.edit', $id)
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
		$this->test->find($id)->delete();

		return Redirect::route('tests.index');
	}

}
