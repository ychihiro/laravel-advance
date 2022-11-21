<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with(['tag', 'user'])->get();
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'user' => $user,
            'tags' => $tags,
        ];
        return view('index', $param);
    }

    public function add(TodoRequest $request)
    {
        $form = $request->all();
        $form['user_id'] = Auth::id();
        Todo::create($form);
        return redirect('/home');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/home');
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/home');
    }

    public function keyword()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = '';
        $param = [
            'user' => $user,
            'tags' => $tags,
            'todos' => $todos
        ];
        return view('search', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $keyword = $request->input('keyword');
        $category = $request->input('tag_id');
        $result = Todo::query();
        if ($keyword !== null) {
            $result->where('title', 'like', '%' . $keyword . '%');
        };
        if ($category !== null) {
            $result->where('tag_id', $category);
        };
        $todos = $result->get();
        $param = [
            'user' => $user,
            'tags' => $tags,
            'todos' => $todos
        ];
        return view('search', $param);
    }

    public function return(Request $request)
    {
        $todos = Todo::with(['tag', 'user'])->get();
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'user' => $user,
            'tags' => $tags,
        ];
        return view('index', $param);
    }

    public function logout()
    {
        return view('auth.login');
    }
}
