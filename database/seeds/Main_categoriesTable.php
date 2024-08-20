<?php

use Illuminate\Database\Seeder;

class Main_categoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Main_categories')->insert([
            ['main_category' => '朝ごはん'],
            ['main_category' => '昼ごはん'],
            ['main_category' => '夜ごはん'],
            ['main_category' => '甘いもの'],
        ]);
    }
}
