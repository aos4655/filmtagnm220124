<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creamos 50 POSTS
        $films = Film::factory(10)->create();
        //ASIGNAMOS A CADA POSTS un numero aeatorio de tags y lo guardamos en post_tag
        foreach ($films as $item) {
            $item->tags()->attach($this->devolverIdTagsRandom());//Con el attach se lo añado
        }
    }
    private function devolverIdTagsRandom() : array{
        $tags = [];
        $arrayTags = Tag::pluck('id')->toArray();// [1,2,3,4,5] -> 0,1,2,3,4
        $arrayIndices = array_rand($arrayTags, random_int(2, count($arrayTags))); //[0,1], 0 , [0,1,3], [3,4]
        foreach ($arrayIndices as $indice) {
            $tags[] = $arrayTags[$indice];
        }
        return $tags;
    }
}
