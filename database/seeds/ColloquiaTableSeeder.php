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
              'training_id' => 2,
              'start_date' => Carbon::now()->addDay(5),
              'end_date' => Carbon::now()->addDay(5)->addHour(1),
              'speaker' => 'John Doe',
              'email' => 'john.doe@st.hanze.nl',
              'location' => 'ZP11/A139 T30',
              'description' => 'In scelerisque fermentum mauris a suscipit. Proin eget nunc non velit suscipit vestibulum.',
              'status' => Colloquium::ACCEPTED,
              'language' => 'Nederlands',
              'token' => str_random(10),
          ],
          [
              'id' => 2,
              'title' => 'Lorem ipsum dolar sir amet',
              'training_id' => 3,
              'start_date' => Carbon::now()->addDay(6),
              'end_date' => Carbon::now()->addDay(6)->addHour(1),
              'speaker' => 'John Doe',
              'email' => 'john.doe@st.hanze.nl',
              'location' => 'ZP11/A139 T30',
              'description' => 'In scelerisque fermentum mauris a suscipit. Proin eget nunc non velit suscipit vestibulum.',
              'status' => Colloquium::AWAITING,
              'language' => 'Nederlands',
              'token' => str_random(10),
          ]
        ];

        foreach($colloquia as $colloquium) {
            Colloquium::create($colloquium);
        }
    }
}
