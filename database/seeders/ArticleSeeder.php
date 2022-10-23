<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0;$i<4;$i++){
            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$faker->sentence(5),
                'image'=>$faker->imageUrl('800','400','cats',true,'Faker'),
                'content'=>$faker->text,
                'created_at'=>$faker->dateTime('now')
            ]);
        }
    }
}
