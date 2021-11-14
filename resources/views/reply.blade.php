/*@extends('layout')

@section('content')
<h1>「{{$question->title}}」に返信する</h1>
    {{ Form::model($question, ['route' => ['question.reply', $question->id]]) }}
        <div class='form-group'>
            {{ Form::label('question_reply', '返信内容：') }}
            {{ Form::text('title', null) }}
        </div>
        <div class="form-group">
            {{ Form::submit('返信する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
    </div>

@endsection*/