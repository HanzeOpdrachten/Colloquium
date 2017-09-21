<?php

use App\Colloquium;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ColloquiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Firstly remove all existing records to clean up the table
        Colloquium::truncate();

        $colloquia = [
            [
                'id' => 1,
                'title' => 'Lorem ipsum vendor',
                'training_id' => 1,
                'start_date' => Carbon::now()->addDay(5),
                'end_date' => Carbon::now()->addDay(5)->addHour(1),
                'speaker' => 'John Doe',
                'location' => 'ZP11/A139 T30',
                'description' => 'In scelerisque fermentum mauris a suscipit. Proin eget nunc non velit suscipit vestibulum.',
                'status' => Colloquium::ACTIVE,
                'language' => 'Nederlands',
            ]
        ];

        foreach($colloquia as $colloquium) {
            Colloquium::create($colloquium);
        }
    }
}
