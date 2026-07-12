<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SparePart;
use Illuminate\Database\Seeder;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        $starter = Category::where('name', 'Dinamo Starter')->first();
        $ampere = Category::where('name', 'Dinamo Ampere')->first();
        $aki = Category::where('name', 'Aki')->first();

        $parts = [
            ['category_id' => $starter->id, 'name' => 'Bendix Starter', 'part_number' => 'BX-100', 'brand' => 'Denso', 'unit' => 'pcs', 'stock_minimum' => 5, 'stocks' => [['condition' => 'new', 'stock' => 20, 'price' => 45000], ['condition' => 'used', 'stock' => 5, 'price' => 25000]]],
            ['category_id' => $starter->id, 'name' => 'Brush Starter', 'part_number' => 'BR-200', 'brand' => 'Denso', 'unit' => 'set', 'stock_minimum' => 5, 'stocks' => [['condition' => 'new', 'stock' => 15, 'price' => 30000]]],
            ['category_id' => $ampere->id, 'name' => 'Kumparan Ampere', 'part_number' => 'AM-300', 'brand' => 'Nippon Denso', 'unit' => 'pcs', 'stock_minimum' => 3, 'stocks' => [['condition' => 'new', 'stock' => 10, 'price' => 120000]]],
            ['category_id' => $aki->id, 'name' => 'Aki Kering 12V', 'part_number' => 'AK-12V', 'brand' => 'GS Astra', 'unit' => 'pcs', 'stock_minimum' => 5, 'stocks' => [['condition' => 'new', 'stock' => 12, 'price' => 350000]]],
        ];

        foreach ($parts as $data) {
            $stocks = $data['stocks'];
            unset($data['stocks']);

            $part = SparePart::create($data);

            foreach ($stocks as $stock) {
                $part->stocks()->create($stock);
            }
        }
    }
}