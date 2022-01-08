@extends('layout')

@section('content')
    <h4>新規投稿</h4><br>
    {{ Form::open(['route' => 'question.store']) }}
        <div class='form-group'>
            {{ Form::label('title', 'タイトル名:') }}<br>
            {{ Form::text('title', null) }}<br>
        </div>
        <div class='form-group','textarea'>
            {{ Form::label('question_content', '質問内容:') }}<br>
            {{ Form::textarea('question_content', null) }}<br>
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', 'カテゴリ:') }}<br>
            {{ Form::select('category_id', $categories) }}<br>
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
        resize:none;
    }
</style>