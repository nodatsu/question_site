@extends('layout')

@section('content')
        <h1>質問一覧</h1>

        @foreach ($questions as $question)
            <p>
                {{ $question->category->name }},
                {{ $question->title}},
                {{ $question->question_content}}
            </p>
   @endforeach
@endsection
