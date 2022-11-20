<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TodoList</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Domine&display=swap" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="ttl-container">
      <h1 class="ttl">Todo List</h1>
      @if (Auth::check())
      <p class="user">「{{$user->name}}」でログイン中</p>
      @endif
      <form action="/home" method="GET">
        <input type="submit" value="ログアウト" class="out-btn">
      </form>
    </div>
    <form action="/search" method="GET">
      <input type="submit" value="タスク検索" class="search-btn">
    </form>
    <form action="/add" method="POST">
      @csrf
      @error('title')
      <p class="error">{{$message}}</p>
      @enderror
      <div class="ttl-box">
        <input type="text" name="title" class="add-ttl">
        <select name="tag_id">
          @foreach ($tags as $tag)
          <option value="{{$tag->id}}">{{$tag->category}}</option>
          @endforeach
        </select>
        <input type="submit" value="追加" class="add-btn">
      </div>
    </form>
    <table class="list">
      <tr class="list-ttl">
        <th width="30%">作成日</th>
        <th width="30%">タスク名</th>
        <th width="10%">タグ名</th>
        <th width="10%">更新</th>
        <th width="10%">削除</th>
      </tr>
      @foreach ($todos as $todo)
      <tr>
        <td>{{$todo->created_at}}</td>
        <form action="/update/{{$todo->id}}" method="POST">
          @csrf
          <td><input type=" text" name="title" value="{{$todo->title}}" class="ttl-list"></td>
          <td>
            <select name="tag_id">
              @foreach ($tags as $tag)
              <option value="{{$tag->id}}" @if ($tag->id == $todo->tag_id) selected @endif>{{$tag->category}}</option>
              @endforeach
            </select>
          </td>
          <td><input type="submit" value="更新" class="update-btn"></td>
        </form>
        <form action="/delete/{{$todo->id}}" method="POST">
          @csrf
          <td><input type="submit" value="削除" class="del-btn"></td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
  </div>
</body>

</html>