<?php

use Illuminate\Database\Seeder;

class Sub_categoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Sub_categories')->insert([
            ['sub_category' => 'パン'],
            ['sub_category' => '魚定食'],
            ['sub_category' => 'チョコ'],
            ['sub_category' => '野菜'],
            ['sub_category' => 'ドーナツ'],
            ['sub_category' => '牛丼'],
            ['sub_category' => 'お茶漬け'],
            ['sub_category' => 'サラダ'],
        ]);
    }
}
