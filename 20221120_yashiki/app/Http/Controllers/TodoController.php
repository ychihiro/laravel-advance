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
        $search = '';
        $param = [
            'user' => $user,
            'tags' => $tags,
            'search' => $search
        ];
        return view('search', $param);
    }

    public function search(Request $request)
    {
        $search = $request->all();
        $user = Auth::user();
        $tags = Tag::all();
        $todos = Todo::with(['tag', 'user'])->where('title', 'like', '%' . $request->input('keyword') . '%')->orWhere('tag_id', '=', $request->input('tag_id'))->get();
        $param = [
            'search' => $search,
            'user' => $user,
            'tags' => $tags,
            'todos' => $todos
        ];
        return view('search', $param);
    }

    public function return(Request $request)
    {
        $form = $request->all();
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'form' => $form,
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
