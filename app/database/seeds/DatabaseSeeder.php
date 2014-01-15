<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('AlunosTableSeeder');
		$this->call('StudentsTableSeeder');
		$this->call('AffiliatesTableSeeder');
		$this->call('LanguagesTableSeeder');
		$this->call('TestsTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('AlternativesTableSeeder');
		$this->call('AudioTableSeeder');
	}

}