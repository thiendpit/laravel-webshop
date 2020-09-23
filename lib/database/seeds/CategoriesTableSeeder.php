<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'cate_name' => 'Iphone',
                'cate_slug' => str_slug('iphone')
            ],
            [
                'cate_name' => 'Samsung',
                'cate_slug' => str_slug('samsung')
            ],
        ];
        DB::table('vp_categories')->insert($data);
    }
}
