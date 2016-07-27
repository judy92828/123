<?php

use Illuminate\Database\Seeder;

class Categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            '0'=>[
                'name'=>'活力四川',
                'alias'=>'vitalitySichuan',
                'type'=>'0',
                'parent_id'=>'0',
            ],
            '1'=>[
                'name'=>'吃喝玩乐',
                'alias'=>'BEER AND SKITTLES',
                'type'=>'0',
                'parent_id'=>'1',
            ],
            '2'=>[
                'name'=>'健康之旅',
                'alias'=>'HEALTH JOURNEY',
                'type'=>'0',
                'parent_id'=>'1',
            ],
            '3'=>[
                'name'=>'阳光校园',
                'alias'=>'SUNSHINE CAMPUS',
                'type'=>'0',
                'parent_id'=>'1',
            ],
            '4'=>[
                'name'=>'阳光校园',
                'alias'=>'originalVideo',
                'type'=>'1',
                'parent_id'=>'0',
            ],
            '5'=>[
                'name'=>'生命的秘密',
                'alias'=>'THE SECRET OF LIFE',
                'type'=>'1',
                'parent_id'=>'5',
            ],
            '6'=>[
                'name'=>'能量管理场',
                'alias'=>'ENEREY FIELD',
                'type'=>'1',
                'parent_id'=>'5',
            ],
            '7'=>[
                'name'=>'每日健康操',
                'alias'=>'DAILY PHYSICAL',
                'type'=>'1',
                'parent_id'=>'5',
            ],

            '8'=>[
                'name'=>'大医精诚',
                'alias'=>'SincerePhysicians',
                'type'=>'0',
                'parent_id'=>'0',
            ],
            '9'=>[
                'name'=>'医师风采',
                'alias'=>'PHYSICIAN',
                'type'=>'0',
                'parent_id'=>'9',
            ],
            '10'=>[
                'name'=>'健康访谈',
                'alias'=>'HEALTH INTERVIEW',
                'type'=>'1',
                'parent_id'=>'9',
            ],
            '11'=>[
                'name'=>'专家说',
                'alias'=>'EXPERTS SAY',
                'type'=>'0',
                'parent_id'=>'9',
            ],
            '12'=>[
                'name'=>'健康公益',
                'alias'=>'PublicHealth',
                'type'=>'0',
                'parent_id'=>'0',
            ],
            '13'=>[
                'name'=>'互助公社',
                'alias'=>'MUTUAL COMMUNE',
                'type'=>'0',
                'parent_id'=>'13',
            ],
            '14'=>[
                'name'=>'志愿者服务中心',
                'alias'=>'VOLUNTEERS SERVICE CENTER',
                'type'=>'0',
                'parent_id'=>'13',
            ],
            '15'=>[
                'name'=>'健康故事',
                'alias'=>'HEALTH STORY',
                'type'=>'0',
                'parent_id'=>'13',
            ],
            '16'=>[
                'name'=>'时事要闻',
                'alias'=>'TOP NEWS',
                'type'=>'0',
                'parent_id'=>'0',
            ],
            '17'=>[
                'name'=>'大话健康',
                'alias'=>'INTERESTING INFORMATION',
                'type'=>'0',
                'parent_id'=>'0',
            ],







        ]);
    }
}
