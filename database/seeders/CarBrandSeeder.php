<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarBrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Land Cruiser'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot'],
            'Volkswagen' => ['Golf', 'Passat', 'Tiguan', 'Touareg'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE']
        ];

        foreach ($brands as $brandName => $models) {
            $brand = CarBrand::create([
                'name' => $brandName,
                'slug' => \Str::slug($brandName),
            ]);

            foreach ($models as $modelName) {
                CarModel::create([
                    'brand_id' => $brand->id,
                    'name' => $modelName,
                    'slug' => \Str::slug($modelName),
                    'year_from' => rand(2010, 2015),
                    'year_to' => rand(2016, 2024)
                ]);
            }
        }
    }
} 