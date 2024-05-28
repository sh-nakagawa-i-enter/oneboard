<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // お気に入り追加している投稿の一覧を作成日時の降順で取得
            $boards = \Auth::user()->feed_favoreites()->active()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'boards' => $boards,
            ];
        }
        
        // ユーザー一覧ビューでそれを表示
        return view('user_favorite.index', [
            'boards' => $boards
        ]);
    }
    
    /**
     * ポストをお気に入り登録するアクション。
     *
     * @param  $id  投稿ポストのid
     * @return \Illuminate\Http\Response
     */
    public function store(string $id)
    {
        // 認証済みユーザー（閲覧者）が、 idのポストを登録する
        \Auth::user()->favorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * お気に入りポストを解除するアクション。
     *
     * @param  $id  投稿ポストのid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // 認証済みユーザー（閲覧者）が、 idのポストを解除する
        \Auth::user()->unfavorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }
}
