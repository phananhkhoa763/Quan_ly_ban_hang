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
        // $this->call(UsersTableSeeder::class);
		 $this->call('HoivienDatabaseSeeder');
		 factory(App\lichSu::class, 100)->create();
    }
}
class HoivienDatabaseSeeder extends Seeder
{
    public function run()
    {
         DB::table('hoivien')->insert([
            ['tenhv' => 'khoa123',
            'ngaysinh' => '2018-12-05',
			'created_at' => new DateTime,
			'updated_at' => new DateTime],
			 ['tenhv' => 'khoa1234',
            'ngaysinh' => '2018-12-05',
			'created_at' => new DateTime,
			'updated_at' => new DateTime]
        ]);
    }
}