@extends('layout')

@section('content')
        <h1>質問一覧</h1>

<table class='table table-striped table-hover'>
    <tr>
            <th>カテゴリ</th><th>タイトル</th><th>質問内容</th>
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
            </p>
   @endforeach
   </table>
@endsection
