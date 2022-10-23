<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image'=>'https://www.cporyapark.com/oryaparkmagazin/wp-content/uploads/2018/06/5-1024x682.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Nullam varius leo id ligula rutrum, quis imperdiet sem rutrum.
                Integer id lorem nec risus molestie imperdiet.
                Cras tortor tellus, tempor a libero vel, fermentum euismod nunc.
                Mauris malesuada, augue nec interdum convallis, eros ligula ultrices turpis, convallis rhoncus elit nisi eget elit.
                Nullam leo nisl, ultricies eget egestas in, dapibus bibendum mauris. Vivamus dignissim finibus mauris, quis laoreet lacus vestibulum eget.
                Phasellus ultricies tempor vestibulum. Curabitur volutpat consequat eros porttitor rutrum.
                Cras eu commodo neque, ut rutrum nulla. Curabitur velit nunc, tincidunt nec condimentum eget, feugiat vel ligula.
                In maximus condimentum nisl, in viverra ante laoreet sit amet.',
                'order'=>$count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
