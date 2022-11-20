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
        $todos = Todo::with(['tag', 'user']);
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
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }

    public function keyword()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'user' => $user,
            'tags' => $tags,
        ];
        return view('search', $param);
    }

    public function search()
    {
        $todos = with(['tag', 'user']);
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'user' => $user,
            'tags' => $$tags
        ];
        return view('search', $param);
    }

    public function return(Request $request)
    {
        $form = $request->all();
        $title = $request->keyword->get();
        $category = $request->category->get();
        $user = Auth::user();
        $tags = Tag::all();
        $query = Todo::query();
        $query->where('title', 'like', $title)->orWhere('category', '=', $category);
        $param = [
            'form' => $form,
            'user' => $user,
            'tags' => $tags,
        ];
        return view('index', $param);
    }
}
