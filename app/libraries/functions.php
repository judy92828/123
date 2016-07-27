<?php

//获取分类名
if (! function_exists('category'))
{
    function category($id)
    {
        $cate = \App\Http\Controllers\Model\Category::find($id);
        return $cate;
    }
}

//获取广告位置
if(!function_exists('adv')){
    function adv($id){
        $adv=\App\Http\Controllers\Model\ads::where('position_id',$id)->where('status','2')->orderByRaw('rand()')->first();
        return $adv;
    }
}

/**
 *   实现中文字串截取
 */
if(!function_exists('getSubstr')) {
    function getSubstr($string, $start, $length)
    {
        if (mb_strlen($string, 'utf-8') > $length) {
            $str = mb_substr($string, $start, $length, 'utf-8');
            return $str . '...';
        } else {
            return $string;
        }
    }
}


//获取路由
if(!function_exists('getRoute')) {
    function getRoute($id)
    {
        $arr = array(
            '1' => 'vitality',
            '5' => 'originalvideo',
            '9' => 'doctor',
            '13' => 'welfare',
        );
        if (array_key_exists($id, $arr)) {
            return $arr[$id];
        } else {
            return '#';
        }
    }
}

//热门文章链接跳转
if(!function_exists('arclink')){
    function arclink($id){
        //查询文章类别ID
        $cateid=\App\Http\Controllers\Model\Article::where('id');
        return $cateid;
    }
}

//获取文章介绍
if(!function_exists('getinfo')){
    function getinfo($id,$type){
        if($type==0){
            $data=\App\Http\Controllers\Model\Article::find($id);
            if($data['status']==2){
                return $data;
            }
        }else{
            $data=\App\Http\Controllers\Model\Videos::find($id);
            if($data['status']==2){
                return $data;
            }
        }
    }
}