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
    <div>
        <div class="center">
        <a href={{ route('question.list') }}>一覧に戻る</a>
        
        @empty($question->user->name)
        回答機能を使うにはログインする必要があります！
        @endempty
        
    @auth
    
     @if ($question->user_id === $login_user_id)
        <a href={{ route('question.edit', ['id' =>  $question->id]) }}>質問内容を編集</a>
        
        {{ Form::open(['method' => 'delete', 'route' => ['question.destroy', $question->id]]) }}
            {{ Form::submit('質問内容を削除',['class' => 'btn btn-outline-danger']) }}
        {{ Form::close() }}
        @endif
        </div>
    <p><h3>回答一覧</h3></p>
        
        @foreach ($replies as $reply) 
        <p>・{{$reply->question_reply}}
        -{{$question->user->name}}-</p>
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