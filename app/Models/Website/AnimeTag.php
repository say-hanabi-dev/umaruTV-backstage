<?php

namespace App\Models\Website;


use App\Models\Model;

class AnimeTag extends Model
{
    public static function association($id,array $tag_id){
        $data = [];
        foreach ($tag_id as $t){
            $data[] = ['tag_id'=>$t,'anime_id'=>$id];
        }
        return AnimeTag::insert($data);
    }
    public static function changeAssociation($id,array $tag_id){
        $affected = 0;
        if (empty($tag_id))
            return $affected;
        $self = new self();

        $anime_tag = $self->select('id','tag_id')->where('anime_id',$id)->get()->toArray();
        // 在数据库中出现却没在表单里出现的，是要删除的关系
        $delete = array_diff(array_column($anime_tag,'tag_id'),$tag_id);
        // 反之就是要增加的关系
        $create = array_diff($tag_id,array_column($anime_tag,'tag_id'));

        $delete_id = array_filter($anime_tag,function ($value)use($delete){
            return in_array($value['tag_id'],$delete);
        });
        $delete_id = array_column($delete_id,'id');

        $insert = array();
        foreach ($create as $tag_id){
            $insert[] = ['anime_id'=>$id,'tag_id'=>$tag_id];
        }
        $affected += $self->destroy($delete_id);
        $affected += $self->insert($insert);
        return $affected;
    }
}
