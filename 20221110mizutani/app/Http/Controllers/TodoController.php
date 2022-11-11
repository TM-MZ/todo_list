<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Tag;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::where('user_id', $user->id)->get();
        $tags =  Tag::all();
        return view('index', ['todos' => $todos, 'tags' => $tags, 'user' => $user]);
    }
    public function create(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
    }
    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return back();
    }
    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return back();
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        return view('find', ['user' => $user, 'tags' => $tags]);
    }
    public function find(Request $request)
    {
        $tags = Tag::all();
        $tag_id = $request->tag_id;
        $user = Auth::user();
        $content = $request->content;
        if($content==""){
            if($tag_id==""){
                $todos = Todo::where('user_id',$user->id)->get();
            } else {
                $todos = Todo::where('user_id',$user->id)->where('tag_id',$tag_id)->get();
            }
        }else{
            if($tag_id==""){
                $todos = Todo::where('user_id', $user->id)->where('content','like', "%$content%")->get();
            } else {
                $todos = Todo::where('user_id', $user->id)->where('tag_id',$tag_id)->where('content','like', "%$content%")->get();
            }
        }
        return view('find', ['todos'=>$todos, 'user'=>$user,'tags'=>$tags]);
    }
}
