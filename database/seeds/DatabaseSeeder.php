<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'michal@mediaeffectivegroup.pl',
            'password' => bcrypt('secret'),
        ]);

        // $this->call(UsersTableSeeder::class);
        $entries = factory(App\Entry::class, 30)->create();

        $subjects = factory(App\Subject::class, 10)->create();

        $statuses = ['Przyjęte','W trakcie','Zrealizowane'];

        foreach($statuses as $status) {
           $status = factory(App\Status::class)->create([
             'name' => $status,
            ]);
        }
    }
}
