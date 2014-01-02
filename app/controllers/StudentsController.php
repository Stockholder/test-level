<?php

class StudentsController extends BaseController {

	/**
	 * Student Repository
	 *
	 * @var Student
	 */
	protected $student;

	public function __construct(Student $student)
	{
		$this->student = $student;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$students = $this->student->all();

		return View::make('students.index', compact('students'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('students.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Student::$rules);

		if ($validation->passes())
		{
			$this->student->create($input);

			return Redirect::route('students.index');
		}

		return Redirect::route('students.create')
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
		$student = $this->student->findOrFail($id);

		return View::make('students.show', compact('student'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$student = $this->student->find($id);

		if (is_null($student))
		{
			return Redirect::route('students.index');
		}

		return View::make('students.edit', compact('student'));
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
		$validation = Validator::make($input, Student::$rules);

		if ($validation->passes())
		{
			$student = $this->student->find($id);
			$student->update($input);

			return Redirect::route('students.show', $id);
		}

		return Redirect::route('students.edit', $id)
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
		$this->student->find($id)->delete();

		return Redirect::route('students.index');
	}

}
