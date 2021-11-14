@extends('layout')

@section('content')
        <p><h1>質問一覧</h1></p>

<table class='table table-striped table-hover'>
    <tr>
            <th>カテゴリ</th><th>タイトル</th><th>質問内容</th><th>投稿者</th>
        </tr>
        @foreach ($questions as $question)
        <tr>
            <td>{{ $question->category->name }}</td>
            
            <td>
                <a href={{ route('question.detail', ['id' =>  $question->id]) }}>
                        {{ $question->title }}
                    </a>
                    </td>
                
            <td>{{ $question->question_content}}</td>
            
            <td>{{ $question->user->name}}</td>
            </p>
   @endforeach
   </table>
   
   @auth
   <div>
        <a href={{ route('question.new') }} class='btn btn-outline-primary'>質問投稿</a>
    <div>
    @endauth
@endsection
