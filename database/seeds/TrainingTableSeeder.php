<?php

use App\Training;
use Illuminate\Database\Seeder;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First, remove all existing records to clean up the table
        Training::truncate();

        $trainings = [
            ['id' => 1, 'name' => 'HBO-ICT', 'color' => '#c62828'],
            ['id' => 2, 'name' => 'Accountancy', 'color' => '#ad1457'],
            ['id' => 3, 'name' => 'Architectuur', 'color' => '#0277bd'],
            ['id' => 4, 'name' => 'Bedrijfskunde', 'color' => '#1565c0'],
            ['id' => 5, 'name' => 'Chemie', 'color' => '#00695c'],
        ];

        foreach($trainings as $training) {
            Training::create($training);
        }
    }
}
