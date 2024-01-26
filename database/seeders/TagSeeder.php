<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'tag1' => "#0A1D56",
            'tag2' => "#492E87",
            'tag3' => "#37B5B6",
            'tag4' => "#F2F597"
        ];
        foreach ($tags as $n => $v) {
            Tag::create([
                'nombre' => $n,
                'color' => $v
            ]);
        }
    }
}
