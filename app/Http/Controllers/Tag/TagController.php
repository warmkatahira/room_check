<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Tag;
// サービス
use App\Services\Tag\TagService;
// リクエスト
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
{
    public function index()
    {
        // タグを全て取得
        $tags = Tag::getAll()->get();
        return view('tag.index')->with([
            'tags' => $tags,
        ]);
    }

    public function create_index()
    {
        return view('tag.create')->with([
        ]);
    }

    public function create(TagCreateRequest $request)
    {
        // インスタンス化
        $TagService = new TagService;
        // タグを追加
        $TagService->createTag($request);
        return redirect()->route('tag.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'タグ追加が完了しました。',
        ]);
    }

    public function update_index(Request $request)
    {
        // タグを取得
        $tag = Tag::getSpecify($request->tag_id)->first();
        return view('tag.update')->with([
            'tag' => $tag,
        ]);
    }

    public function update(TagUpdateRequest $request)
    {
        // インスタンス化
        $TagService = new TagService;
        // タグを更新
        $TagService->updateTag($request);
        return redirect()->route('tag.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'タグ更新が完了しました。',
        ]);
    }

    public function delete(Request $request)
    {
        // インスタンス化
        $TagService = new TagService;
        // タグを削除
        $TagService->deleteTag($request);
        return redirect()->route('tag.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'タグ削除が完了しました。',
        ]);
    }
}
