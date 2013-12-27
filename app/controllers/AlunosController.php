<?php

class AlunosController extends BaseController {

	protected $aluno;

	public function __construct(Aluno $aluno) 
	{
		$this->aluno = $aluno;	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$alunos = $this->aluno->all();

        return View::make('alunos.index', compact('alunos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('alunos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$v = Validator::make($input, Aluno::$rules);

		if ($v->passes()) {
			$this->aluno->create($input);

			return Redirect::route('alunos.index');
		}

		return Redirect::route('alunos.create')
			->withInput()
			->withErrors($v)
			->with('message', 'There were validation errors');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$aluno = $this->aluno->findOrFail($id);

        return View::make('alunos.show', compact('aluno'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$aluno = $this->aluno->find($id);

		if (is_null($aluno)) 
		{
			return Redirect::route('alunos.index');	
		}

        return View::make('alunos.edit', compact('aluno'));
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
		
		$v = Validator::make($input, Aluno::$rules);

		if ($v->passes()) 
		{
			$aluno = $this->aluno->find($id);
			$aluno->update($input);

			return Redirect::route('alunos.show', $id);
		}

		return Redirect::route('alunos.edit', $id)
			->withInput()
			->withErrors($v)
			->with('message', 'There were validation errors');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->aluno->find($id)->delete();

		return Redirect::route('alunos.index');
	}

}
