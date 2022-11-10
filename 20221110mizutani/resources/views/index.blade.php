<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="/css/common.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card__header">
                <p class="title mb-15">Todo List</p>
                <div class="auth mb-15">
                    <p class="detail">「{{$user->name}}」でログイン中</p>
                    <form method="post" action="/logout">
                        @csrf
                        <input type="submit" class="btn btn-logout" value="ログアウト">
                    </form>
                </div>
            </div>
            <a href="/search" class="btn btn-search">タスク検索</a>

            <div class="todo">
                @error('content')
                <ul>
                    <li>{{$message}}</li>
                </ul>
                @enderror
                <form action="/create" method="POST" class="flex between mb-30">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="text" name="content" class="input-add">
                    <select name="tag_id" class="select-tag">
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->content}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-add" value="追加">
                </form>
                <table>
                    <tr>
                        <th>作成日</th>
                        <th>タスク名</th>
                        <th>タグ</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                    @foreach($todos as $todo)
                    <tr>
                        <td>{{$todo->created_at}}</td>
                        <form action="/update?id={{$todo->id}}" method="POST">
                            @csrf
                            <td>
                                <input type="text" class="input-update" name="content" value="{{$todo->content}}">
                            </td>
                            <td>
                                <select name="tag_id" class="select-tag">
                                    @foreach($tags as $tag)
                                        @if($tag->id==$todo->tag_id)
                                            <option value="{{$tag->id}}" selected>{{$tag->content}}</option>
                                        @else
                                            <option value="{{$tag->id}}">{{$tag->content}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="submit" class="btn btn-update" value="更新">
                            </td>
                        </form>
                        <td>
                            <form action="/delete?id={{$todo->id}}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-delete" value="削除">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>