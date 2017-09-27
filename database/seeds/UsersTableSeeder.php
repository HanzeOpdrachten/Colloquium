<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'j.doe@pl.hanze.nl',
                'password' => bcrypt('secret'),
                'role' => User::ADMIN,
            ],
            [
                'id' => 2,
                'name' => 'Richard Winsoin',
                'email' => 'r.winsoin@pl.hanze.nl',
                'password' => bcrypt('secret'),
                'role' => User::PLANNER,
            ],
//            [
//                'id' => 3,
//                'name' => 'Damian van Olsson',
//                'email' => 'd.v.olsson@st.hanze.nl',
//                'password' => bcrypt('secret'),
//                'role' => User::STUDENT,
//            ],
        ];

        foreach($users as $user) {
            User::create($user);
        }

        \DB::table('mail_subscriptions')->truncate();

        // Subscribe the `planner` to a few trainings
        $subscriptions = [
            1, 2, 3,
        ];

        $user = User::find(2);

        foreach($subscriptions as $training) {
            $user->subscriptions()
                ->attach($training);
        }
    }
}
