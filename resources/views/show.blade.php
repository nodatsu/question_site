@extends('layout')

@section('content')
    
    
    
<table class='table table-striped table-hover'>
    <h4>{{ $question->title }}</h4>
    
    <tr><th><p>カテゴリー</p></th></tr>
    <tr><td>{{ $question->category->name }}</td></tr>

    <tr><td><p>質問内容</p></td></tr>
    <tr><td>{{ $question->question_content }}</td></tr>
    <tr><td><p>投稿者名</p></td></tr>
        <tr><td>{{$question->user->name}}</td></tr>
    </tr>


{{--
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
--}}
<!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
<tr><td><p>知りたい：{{$question->interests()->count()}}<br><br>
@auth
    <span>
        @isset($interest)
        <!-- 「いいね」取消用ボタンを表示 -->
        	<a href="{{ route('uninterest', $question) }}" class="btn btn-danger btn-sm">
        		知りたいを取り消す
        		<!-- 「いいね」の数を表示 -->
        	</a>
        	</p></td></tr>
        @else
        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
        	<a href="{{ route('interest', $question) }}" class="btn btn-success btn-sm">
        		知りたい
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $question->interests()->count() }}
        		</span>
        	</a>
        	</p></td></tr>
        @endisset
    </span>
@endauth
</table>
<p></p>

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
    
    
    
    @auth
        @empty($question->user_id)
        
        @else
        
            {{ Form::open(['route' => ['question.reply', ['id' =>  $question->id]]]) }}
                
                <div class='form-group textarea'>
                    {{ Form::label('question_show', '返信内容：') }}<br>
                    {{ Form::textarea('question_reply', null) }}<br>
                </div>
                <div class='form-group'>
                    {{ Form::submit('返信する', ['class' => 'btn btn-outline-primary']) }}<br>
                </div>
            
            {{ Form::close() }}
        @endempty
        <p></p>
    @endauth
    <p></p>
    <p><h4>回答一覧</h4></p>
    @foreach ($replies as $reply) 
            
        @php
            $user = \App\User::find($reply->user_id);  
        @endphp
        
        <table class='table table-striped table-hover'>
        <tr><th>{{$user->name}}
            
        @empty($reply->created_at)
            </th></tr>
        @else
            -{{$reply->created_at}}-</th></tr>
        @endempty
        <tr><td><p>{{$reply->question_reply}}</p></td></tr>

        
        <span>
        @if($reply)
            @php
                $good = \App\Good::where('reply_id', $reply->id)->where('user_id',$login_user_id)->first();
            @endphp
            @else
            <p>回答がありません</p>
            @endif
            
            <tr><td><p>いいね：{{$reply->goods()->count()}}<br><br>
        @auth
        @if($reply->user_id!=$login_user_id)
            @isset($good)
            <!-- 「いいね」取消用ボタンを表示 -->
            </p>
            <a href="{{ route('ungood', $reply) }}" class="btn btn-danger btn-sm">
        	いいねを取り消す</p></td></tr>
        	</a>
        	<p></p>
            @else
            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
	        <a href="{{ route('good', $reply) }}" class="btn btn-success btn-sm">
		    いいね</p></td></tr>
		    <!-- 「いいね」の数を表示 -->
	        </a>
	        <p></p>
            @endisset
            @endif
        @endauth
        </span>
        </table>
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
    .textarea{
        width: 100%;
        height: 75px;
    }
    
</style>