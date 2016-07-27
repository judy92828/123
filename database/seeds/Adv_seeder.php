<?php

use Illuminate\Database\Seeder;

class Adv_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_position')->insert([
            '0'=>[
                'name'=>'首页顶部广告',
                'position'=>'1',
            ],
            '1'=>[
                'name'=>'首页(详情页)广告',
                'position'=>'2',
            ],
            '2'=>[
                'name'=>'页面右边广告',
                'position'=>'3',
            ],
            '3'=>[
                'name'=>'大医精诚首页中部',
                'position'=>'4',
            ],

        ]);
    }
}
