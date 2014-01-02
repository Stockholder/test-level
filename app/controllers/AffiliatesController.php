<?php

class AffiliatesController extends BaseController {

	/**
	 * Affiliate Repository
	 *
	 * @var Affiliate
	 */
	protected $affiliate;

	public function __construct(Affiliate $affiliate)
	{
		$this->affiliate = $affiliate;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$affiliates = $this->affiliate->all();

		return View::make('affiliates.index', compact('affiliates'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('affiliates.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Affiliate::$rules);

		if ($validation->passes())
		{
			$this->affiliate->create($input);

			return Redirect::route('affiliates.index');
		}

		return Redirect::route('affiliates.create')
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
		$affiliate = $this->affiliate->findOrFail($id);

		return View::make('affiliates.show', compact('affiliate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$affiliate = $this->affiliate->find($id);

		if (is_null($affiliate))
		{
			return Redirect::route('affiliates.index');
		}

		return View::make('affiliates.edit', compact('affiliate'));
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
		$validation = Validator::make($input, Affiliate::$rules);

		if ($validation->passes())
		{
			$affiliate = $this->affiliate->find($id);
			$affiliate->update($input);

			return Redirect::route('affiliates.show', $id);
		}

		return Redirect::route('affiliates.edit', $id)
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
		$this->affiliate->find($id)->delete();

		return Redirect::route('affiliates.index');
	}

}
