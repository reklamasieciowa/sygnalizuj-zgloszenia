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
            'name' => 'Ernest Wencel',
            'email' => 'zgloszenie@sygnalizuj.com',
            'password' => '$2y$10$JpYHU8htlumC9S2DW1aZJu3gbd9fOTYLKjQCoX0pnz7C0tWdEhUOC',
        ]);

    	DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'michal@mediaeffectivegroup.pl',
            'password' => '$2y$10$6kgU2gWgUQpj0WiUVt72/eaqOeUsU7UO6izxnKDsqVLvgJvBqsflS',
        ]);

        // $this->call(UsersTableSeeder::class);
        $entries = factory(App\Entry::class, 30)->create();

        $subjects = factory(App\Subject::class, 10)->create();

       $status = factory(App\Status::class)->create([
         'name' => 'Przyjęte',
         'color' => '#ff4444',
        ]);

        $status = factory(App\Status::class)->create([
         'name' => 'W trakcie',
         'color' => '#FF8800',
        ]);

        $status = factory(App\Status::class)->create([
         'name' => 'Zrealizowane',
         'color' => '#00C851',
        ]);
        
    }
}
