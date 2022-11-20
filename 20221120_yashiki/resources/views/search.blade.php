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
      <h1 class="ttl">タスク検索</h1>
      @if (Auth::check())
      <p class="user">「{{$user->name}}」でログイン中</p>
      @endif
      <form action="/home" method="GET">
        <input type="submit" value="ログアウト" class="out-btn">
      </form>
    </div>
    <form action="/search" method="POST">
      @csrf
      <div class="ttl-box">
        <input type="text" name="keyword" class="add-ttl">
        <select name="category">
          @foreach ($tags as $tag)
          <option value="{{$tag->id}}">{{$tag->category}}</option>
          @endforeach
        </select>
        <input type="submit" value="検索" class="search-btn">
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
    </table>
    <form action="/return" method="GET">
      <input type="submit" value="戻る">
    </form>
  </div>
</body>

</html>