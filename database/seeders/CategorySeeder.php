<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Двигатель' => [
                'Поршни',
                'Клапаны',
                'Прокладки',
                'Ремни ГРМ'
            ],
            'Тормозная система' => [
                'Тормозные диски',
                'Колодки',
                'Суппорты',
                'Тормозные шланги'
            ],
            'Подвеска' => [
                'Амортизаторы',
                'Пружины',
                'Рычаги',
                'Сайлентблоки'
            ],
            'Электрика' => [
                'Генераторы',
                'Стартеры',
                'Аккумуляторы',
                'Лампы'
            ]
        ];

        foreach ($categories as $mainCategory => $subCategories) {
            $parent = Category::create([
                'name' => $mainCategory,
                'slug' => \Str::slug($mainCategory)
            ]);

            foreach ($subCategories as $subCategory) {
                Category::create([
                    'name' => $subCategory,
                    'slug' => \Str::slug($subCategory),
                    'parent_id' => $parent->id
                ]);
            }
        }
    }
} 