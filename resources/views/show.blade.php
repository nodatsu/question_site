@extends('layout')

@section('content')
    <h1>{{ $question->title }}</h1>
    <div>
        カテゴリー：<p>{{ $question->category->name }}</p>
        質問内容：<p>{{ $question->question_content }}</p>
    </div>
    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
        
    @auth
    <p>回答一覧</p>
        
        @foreach ($replies as $reply) 
        {{ $reply->question_reply}}
        @endforeach
        
        @if ($question->user_id === $login_user_id)
        | <a href={{ route('question.edit', ['id' =>  $question->id]) }}>編集</a>
        <p></p>
        
        {{ Form::open(['method' => 'delete', 'route' => ['question.destroy', $question->id]]) }}
            {{ Form::submit('削除',['class' => 'btn btn-outline-danger']) }}
        {{ Form::close() }}
        @endif
        <p></p>
        
         @empty ($question->user_id)
            回答をするにはログインが必要です！
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