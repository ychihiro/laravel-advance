<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with(['tag', 'user'])->get();
        $user = Auth::user();
        $param = [
            'todos' => $todos,
            'user' => $user,
        ];
        return view('index', ['todos' => $param]);
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
}
