@extends('layout')

@section('content')
    
    
<h1>{{ $question->title }}</h1>
<table class='table table-striped table-hover'>
    <tr>
        <th>カテゴリー</th>
        <div class="normal">
            <th>{{ $question->category->name }}</th>
        </div>
    </tr>
    <tr>
        <div class="bold">
            <td>質問内容</td>
        </div>
        <td>{{ $question->question_content }}</td>
    </tr>
    <tr>
        <div class="bold">
            <td>投稿者名</td>
        </div>
        <td>{{$question->user->name}}</td>
    </tr>
</table>

<!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
@auth
    <span>
        <img src="storage/know.png" width="100" height="100" alt="画像1">
        @isset($interest)
        <!-- 「いいね」取消用ボタンを表示 -->
        	<a href="{{ route('uninterest', $question) }}" class="btn btn-danger btn-sm">
        		知りたいを取り消す
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $question->interests()->count()}}
        		</span>
        	</a>
        @else
        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
        	<a href="{{ route('interest', $question) }}" class="btn btn-success btn-sm">
        		知りたい
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $question->interests()->count() }}
        		</span>
        	</a>
        @endisset
    </span>
@endauth

<div>
    <p>
        <div class="center">
            <a href="{{ route('question.list') }}" class="btn btn-outline-primary">一覧に戻る</a>
        </div>
    </p>
    
    @auth
        <div class="center">
        @if ($question->user_id === $login_user_id)
            <p>
                <a href="{{ route('question.edit', ['id' =>  $question->id]) }}" class="btn btn-outline-info">質問内容を編集</a>
            {{ Form::open(['method' => 'delete', 'route' => ['question.destroy', $question->id]]) }}
                {{ Form::submit('質問内容を削除',['class' => 'btn btn-outline-danger']) }}
            {{ Form::close() }}</p>
            
        @endif
    @endauth
        </div>
    
    <p><h3>回答一覧</h3></p>
    
    @auth
        @empty($question->user_id)
        
        @else
         
            {{ Form::open(['route' => ['question.reply', ['id' =>  $question->id]]]) }}
 
                {{ Form::label('question_show', '返信内容：') }}
                {{ Form::text('question_reply', null) }}
       
                {{ Form::submit('返信する', ['class' => 'btn btn-outline-primary']) }}
            
            {{ Form::close() }}
        @endempty
        <p></p>
    @endauth
        
    @isset($reply)
        <p>
            <select name="narabi2">
                <option value="asc">昇順</option>
                <option value="desc">降順</option>
            </select>
        </p>
    @else
        <p>※回答がないためソート機能が利用出来ません</p>
    @endisset
    
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
            
        <span>
            @auth
                @php
                    $good = \App\Good::where('reply_id', $reply->id)->where('user_id',$login_user_id)->first();
                @endphp
        
                @isset($good)
                <!-- 「いいね」取消用ボタンを表示 -->
            	    <a href="{{ route('ungood', $reply) }}" class="btn btn-danger btn-sm">
        		        いいねを取り消す
        		        <!-- 「いいね」の数を表示 -->
        		        <span class="badge">
        			        {{ $reply->goods()->count()}}
        		        </span>
        	        </a>
                @else
                    <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
        	        <a href="{{ route('good', $reply) }}" class="btn btn-success btn-sm">
        		    いいね
        		    <!-- 「いいね」の数を表示 -->
        		        <span class="badge">
        			        {{ $reply->goods()->count() }}
        		        </span>
        	        </a>
        	        <p></p>
                @endisset
            @endauth
        </span>
    @endforeach
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