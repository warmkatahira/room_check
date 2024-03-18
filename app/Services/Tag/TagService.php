<?php

namespace App\Services\Tag;

// モデル
use App\Models\Tag;

class TagService
{
    // タグを追加
    public function createTag($request){
        Tag::create([
            'tag_name' => $request->tag_name,
            'tag_sort_order' => $request->tag_sort_order,
        ]);
        return;
    }

    // タグを更新
    public function updateTag($request){
        Tag::where('tag_id', $request->tag_id)->update([
            'tag_name' => $request->tag_name,
            'tag_sort_order' => $request->tag_sort_order,
        ]);
        return;
    }

    // タグを削除
    public function deleteTag($request){
        Tag::where('tag_id', $request->tag_id)->delete();
        return;
    }
}