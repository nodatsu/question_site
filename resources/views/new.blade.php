@extends('layout')

@section('content')
    <h1>新規投稿</h1>
    {{ Form::open(['route' => 'question.store']) }}
        <div class='form-group'>
            {{ Form::label('title', 'タイトル名:') }}
            {{ Form::text('title', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('question_content', '質問内容:') }}
            <div class="textarea">
            {{ Form::textarea('question_content', null) }}
            </div>
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', 'カテゴリ:') }}
            {{ Form::select('category_id', $categories) }}
        </div>
        <div class="form-group">
            {{ Form::submit('投稿する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

    <div>
        <a href={{ route('question.list') }}>一覧に戻る</a>
    </div>

@endsection
<style>
    .textarea{
        width:100%;
        height: 75px;
    }
</style>