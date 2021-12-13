@extends('layout')

@section('content')
    
    
    <h1>{{ $question->title }}</h1>
        <table class='table table-striped table-hover'>
            <tr>
                 <th>カテゴリー</th>
                <div class="normal">
                 <th>{{ $question->category->name }}</th></div>
            </tr>
            <tr>
                <div class="bold">
                <td>質問内容</td></div>
                <td>{{ $question->question_content }}</td>
            </tr>
            <tr>
                <div class="bold">
                <td>投稿者名</td></div>
                <td>{{$question->user->name}}</td>
            </tr>
    </table>
    
    
    
<span>
 <img src="storage/know.png" width="100" height="100" alt="画像1">
 
<!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
@isset($interest)
<!-- 「いいね」取消用ボタンを表示 -->
	<a href="{{ route('uninterest', $question) }}" class="btn btn-success btn-sm">
		知りたいを取り消す
		<!-- 「いいね」の数を表示 -->
		<span class="badge">
			{{ $question->interests()->count()}}
		</span>
	</a>
@else
<!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
	<a href="{{ route('interest', $question) }}" class="btn btn-secondary btn-sm">
		知りたい
		<!-- 「いいね」の数を表示 -->
		<span class="badge">
			{{ $question->interests()->count() }}
		</span>
	</a>
@endisset
</span>

   
    
    
    <div>
        <p>
        <div class="center">
        <a href={{ route('question.list') }}>一覧に戻る</a></p>
        
        @empty($question->user->name)
        回答機能を使うにはログインする必要があります！
        @endempty
       
        
    @auth
    
     @if ($question->user_id === $login_user_id)
     <p>
        <a href={{ route('question.edit', ['id' =>  $question->id]) }}>質問内容を編集</a></p>
        
        {{ Form::open(['method' => 'delete', 'route' => ['question.destroy', $question->id]]) }}
            {{ Form::submit('質問内容を削除',['class' => 'btn btn-outline-danger']) }}
        {{ Form::close() }}
        @endif
        </div>
    <p><h3>回答一覧</h3></p>
    
   
    
        @foreach ($replies as $reply) 
        
         @php
        $user = \App\User::find($reply->user_id);    
        @endphp
        {{$user->name}}
        @empty($reply->created_at)
        
        @else
        -{{$reply->created_at}}-
        @endempty
        
        <p>{{$reply->question_reply}}</p>
        <p>
            <img src="storage/good.jpg" width="30" height="30" alt="good">
            いいね：{{$reply->good}}
        <form>
        <button type="" name="good" value"いいね"></button></p><br>
        </form>
        @endforeach
        

       
        <p></p>
        
         @empty($question->user_id)
         @else
         
            {{ Form::open(['route' => ['question.reply', ['id' =>  $question->id]]]) }}
 
                {{ Form::label('question_show', '返信内容：') }}
                {{ Form::text('question_reply', null) }}
       
                {{ Form::submit('返信する', ['class' => 'btn btn-outline-primary']) }}
            
            {{ Form::close() }}
        @endempty
        @endauth
        
        
        
        
    </div>
@endsection
<style>
    .normal{
        font-weight:normal;
    }
    

    .bold{
        font-weight:bold;
    }
    
    .center{
        text-align:center;
    }
    
</style>