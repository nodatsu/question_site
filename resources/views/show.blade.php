@extends('layout')

@section('content')
    <h1>{{ $question->title }}</h1>
    <div>
        <p>{{ $question->category->name }}</p>
        <p>{{ $question->question_content }}</p>
    </div>
    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
        | <a href={{ route('question.edit', ['id' =>  $question->id]) }}>編集</a>
        
        <p></p>
        {{ Form::open(['method' => 'delete', 'route' => ['question.destroy', $question->id]]) }}
            {{ Form::submit('削除',['class' => 'btn btn-outline-danger']) }}
        {{ Form::close() }}
    </div>
@endsection