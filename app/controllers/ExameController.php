<?php

class ExameController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function processing()
	{
		Session::flush();
		Session::regenerate();

		$exam = array();
		
		$language = Language::find(Input::get('idioma'));
		$filial = Affiliate::find(Input::get('filial'));
		$test = Test::where('languages_id',$language->id)->where('active',1)->first();
		$questions = $test->questions()->get();
		$exam['idioma'] = $language->language;
		$exam['filial'] = $filial->city;
		$exam['teste'] = $test->description;
		$exam['respondidas'] = 0;
		for ($i=0; $i < count($questions); $i++) {
			$arr = array();
			// $ids = array();
			// $ids[] = $questions[$i]->id;
			$arr['question']['description'] = $questions[$i]->description;
			$arr['question']['audio'] = $questions[$i]->audio_id;
			$alternatives = Question::find($questions[$i]->id)->alternatives()->get();
			for ($k=0; $k < count($alternatives); $k++) {
				$arr['question']['alternatives'][] = 
				array(
					'id' =>  $alternatives[$k]->id,
					'description' => $alternatives[$k]->description
				);
			}
			if(isset($arr['question']['alternatives']))
				$exam['questions'][] = $arr;
			unset($arr);
			// $exam['ids'][] = $ids;
		}
		$exam['count'] = count($exam['questions']);
		// $queries = DB::getQueryLog();
		// $last_query = end($queries);
		// print_r( $last_query );

		// return $test->questions()->get();
		Session::put('testes', $exam);
		return Redirect::to('exame');

	}

	public function exame()
	{
		$testes = Session::get('testes');
		if(count($testes['questions']) == 0)
				return Redirect::to('inicio');
		if (Request::isMethod('post'))
		{
			$testes['respondidas']++;
			$first = key($testes['questions']);
			unset($testes['questions'][$first]);
			Session::flush();
			Session::put('testes', $testes);
			if(count($testes['questions']) == 0)
				return Redirect::to('fim');
		}

		return View::make('exame.index', compact('testes'));
	}

	public function fim()
	{
		Session::flush();
		return View::make('fim.index');
	}

	public function detectSession()
	{
		$testes = Session::get('testes');
		if(count($testes['questions']) == 0)
			return array('result' => 'true');
		else
			return array('result' => 'false');
	}

	// /**
	//  * Show the form for creating a new resource.
	//  *
	//  * @return Response
	//  */
	// public function create()
	// {
 //        return View::make('audio.create');
	// }

	// /**
	//  * Store a newly created resource in storage.
	//  *
	//  * @return Response
	//  */
	// public function store()
	// {
	// 	//
	// }

	// /**
	//  * Display the specified resource.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function show($id)
	// {
	// 	// $id = array('id' => $id);
 //        // return View::make('exame.show', compact('id'));
	// 	$tests = Test::find(1);
	// 	$language = Language::find($tests->languages_id);
	// 	return $language->language;


 //        // $id = array('id' => $id);
 //        // return View::make('exame.show', compact('id'));
	// }

	// *
	//  * Show the form for editing the specified resource.
	//  *
	//  * @param  int  $id
	//  * @return Response
	 
	// public function edit($id)
	// {
 //        return View::make('audio.edit');
	// }

	// /**
	//  * Update the specified resource in storage.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function update($id)
	// {
	// 	//
	// }

	// /**
	//  * Remove the specified resource from storage.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function destroy($id)
	// {
	// 	//
	// }

}
