<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Grains',
            'Oils',
            'Canned',
            'Dairy',
            'Juices',
            'Vegetables',
            'Fruits',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)], // شرط التحقق
                ['name' => $name, 'slug' => Str::slug($name)] // البيانات المُحدثة
            );
        }
    }
}
