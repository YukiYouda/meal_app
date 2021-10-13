<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $like = new Like();
        
        $like->user_id = Auth::user()->id;
        $like->post_id = $post->id;

        $like->save();

        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'お気に入りを登録しました。');
    }

    public function destroy(Post $post, Like $like)
    {
        $like->delete();

        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'お気に入りを削除しました');
    }
}
