<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Board;

use Carbon¥Carbon;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // delete_flag=0のメッセージを取得
        $boards = Board::with('user')->where('delete_flag', 0)->orderBy('message_id', 'desc')->paginate(10);

        // メッセージ一覧ビューでそれを表示
        if ($boards->isEmpty()) {
            $message = '現在、投稿内容を取得できません';
            return view('board.index', compact('message'));
        }
        return view('board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            //'user_name' => 'required|max:20',
            'message' => 'required|max:140',
        ]);
        
        
        
        //ログインしている自分のIDを取得している
        $user = \Auth::user();
        
        //メッセージを作成
        //セーブができたかどうかの判定と表示
        try {
            $board = new Board;
            $board->user_name = $user->user_name;
            $board->message = $request->message;
            $board->user_id = $user->id;
            $board->save();
            session()->flash('result', '投稿しました！');
        } catch (\Exception $e) {
            session()->flash('noresult', '投稿失敗しました');
        }
        
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        // idの値で投稿を検索して取得
        $message_id = $id;
        $board = Board::where('message_id', $message_id)->firstOrFail();
        
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $board->user_id) {
            $board->delete_flag = 1;
            $board->save();
            return back();
        }

        /*
        $message_id = $id;
        $board = Board::where('message_id', $message_id)->firstOrFail();
        $board->delete_flag = 1;
        $board->save();
        return back();
        */
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
