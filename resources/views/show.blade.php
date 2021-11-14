@extends('layout')

@section('content')
    <h1>{{ $question->title }}</h1>
    <div>
        <p>{{ $question->category->name }}</p>
        <p>{{ $question->question_content }}</p>
    </div>
    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
    </div>
@endsection