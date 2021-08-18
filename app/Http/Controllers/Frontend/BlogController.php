<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Rating;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    function list() {
    	$getBlogList = Blog::orderBy('id','DESC')->paginate(3);
    	return view('frontend.blog-list',compact('getBlogList'));
    }
    function single($id) {  	
    	$getBlogSingle = Blog::findOrFail($id);
    	$next = Blog::where('id','<',$getBlogSingle->id)->max('id');
    	$previous = Blog::where('id','>',$getBlogSingle->id)->min('id');

    	$rating = Rating::where('blog_id',$getBlogSingle->id)->avg('rating');
        $comments = Comment::get();
        $replies = Comment::where('level','>',0)->get();
    	return view('frontend.blog-single',compact('getBlogSingle'))->with('previous',$previous)->with('next',$next)->with('rating',$rating)->with('comments',$comments)->with('replies',$replies);
    }
    public function saveRating(Request $request) {
        if (Auth::user()) {
            $data = $request->all();
            // dd($data);
            $rating = new Rating();
            $rating->blog_id = $data['blog_id'];
            $rating->rating = $data['Values'];
            $rating->save();
            echo "done";
        }
        
    }
    public function add_cmt(Request $request) {
        $data = $request->all();
        $comment = new Comment();
        $comment->blog_id = $data['blog_id'];
        $comment->name = $data['cmt_name'];
        $comment->content = $data['cmt'];
        $comment->save();
        echo "done";
    }
    public function add_reply(Request $request) {
        $data = $request->all();
        $reply = new Comment();
        $reply->blog_id = $data['blog_id'];
        $reply->name = $data['reply_name'];
        $reply->content = $data['reply'];
        $reply->level = $data['cmt_id'];
        $reply->save();
        echo "done";
    }
}
