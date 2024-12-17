<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Category;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $carModels = CarModel::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                $part = Part::create([
                    'name' => "Запчасть {$category->name} #{$i}",
                    'article_number' => 'ART-' . rand(10000, 99999),
                    'category_id' => $category->id,
                    'brand' => ['Original', 'Bosch', 'TRW', 'Denso', 'Febi'][rand(0, 4)],
                    'description' => "Описание запчасти {$category->name} #{$i}",
                    'price' => rand(1000, 50000),
                    'quantity' => rand(5, 50),
                    'is_active' => true
                ]);

                // Привязываем случайные модели автомобилей
                $randomModels = $carModels->random(rand(2, 5));
                foreach ($randomModels as $model) {
                    $part->carModels()->attach($model->id);
                }
            }
        }
    }
} 