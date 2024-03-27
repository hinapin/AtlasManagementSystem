<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name' => '山田',
                'under_name' => '妃那子',
                'over_name_kana' => 'ヤマダ',
                'under_name_kana' => 'ヒナコ',
                'mail_address' => 'hinako@gmail.com',
                'sex' => '2',
                'birth_day' => '1997-11-15',
                'role' => '1',
                'password' => bcrypt('hinako1234'),
            ]
            ]);

    }
}
