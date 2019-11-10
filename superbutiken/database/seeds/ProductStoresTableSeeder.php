<?php

use Illuminate\Database\Seeder;

class ProductStoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_stores')->insert([
            [
                "product_id" => 1,
                "store_id" => 1
            ],
            [
                "product_id" => 1,
                "store_id" => 2
            ],
            [
                "product_id" => 1,
                "store_id" => 3
            ],
            [
                "product_id" => 1,
                "store_id" => 4
            ],
            [
                "product_id" => 2,
                "store_id" => 1
            ],
            [
                "product_id" => 2,
                "store_id" => 3
            ],
            [
                "product_id" => 3,
                "store_id" => 1
            ],
            [
                "product_id" => 3,
                "store_id" => 2
            ],
            [
                "product_id" => 3,
                "store_id" => 3
            ],
            [
                "product_id" => 3,
                "store_id" => 4
            ],
            [
                "product_id" => 4,
                "store_id" => 2
            ],
            [
                "product_id" => 4,
                "store_id" => 4
            ]
        ]);
    }
}
