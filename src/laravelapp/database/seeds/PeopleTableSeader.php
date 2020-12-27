<?php

use Illuminate\Database\Seeder;

class PeopleTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'name' => 'taro',
            'mail' => 'taro@mail.com',
            'age' => 20,
        ];
    }

    DB::table('people')->insert($param);
}
