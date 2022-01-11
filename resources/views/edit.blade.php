@extends('layout')

@section('content')
    <h3>「{{$question->title}}」を編集する</h3>
    {{ Form::model($question, ['route' => ['question.update', $question->id]]) }}
        <div class='form-group'>
            {{ Form::label('title', 'タイトル名:') }}
            {{ Form::text('title', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('question_content', '質問内容:') }}
            {{ Form::textarea('question_content', null, ['rows' => 3]) }}<br>
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', 'カテゴリ:') }}<br>
            {{ Form::select('category_id', $categories) }}
        </div>
        <div class="form-group">
            {{ Form::submit('更新する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
    </div>


<style>
    #title{
    width:100%;
    }
    
    textarea{
        width:100%;
    }
</style>
@endsection
