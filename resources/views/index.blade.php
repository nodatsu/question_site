@extends('layout')

@section('content')
<div class="style1">
</div>

        <p><h3>質問一覧</h3></p>

 @foreach ($questions as $question)
<ul id="accordion_menu">
  <li>
    <a data-toggle="collapse" href={{"#question".$loop->index}} aria-controls={{"#question".$loop->index}} aria-expanded="true">{{$question->title}}</a>
  </li>
  <ul id={{"question".$loop->index}} class="collapse" data-parent="#accordion_menu">
    <li>カテゴリ：{{$question->category->name}}</li>
    <li>質問内容：<br>{{$question->question_content}}</li>
    <li>投稿者：{{$question->user->name}}</li>
    <li><a href="{{ route('question.detail', ['id' =>  $question->id]) }}" class="btn btn-outline-primary">詳細ページへ</a></li>
  </ul>
        
 @endforeach


{{--
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
   --}}
   <p></p>
   @auth
   <div>
        <a href={{ route('question.new') }} class='btn btn-outline-primary'>質問投稿</a>
    <div>
    @endauth
@endsection
<style>
    .style1{
        text-align:center;
    }
    
    ul,li{
    margin: 0;
    padding: 0;
    list-style: none;
}
#accordion_menu > li {
    border: #ccc 1px solid;
    margin-bottom: -1px;
}
#accordion_menu a{
    color: #666;
}
#accordion_menu a[data-toggle="collapse"]{
    display: block;
    padding: 10px;
    text-decoration: none;
  position: relative;
}
#accordion_menu a[data-toggle="collapse"]:hover{
    background: #e7e7e7;
}
#accordion_menu a[data-toggle="collapse"]::after{
    content:"";
    display: block;
    width: 8px;
    height: 8px;
    border-top: #666 1px solid;
    border-right: #666 1px solid;
    position: absolute;
    right: 15px;
    top: 0;
    bottom: 0;
    margin: auto;
}
#accordion_menu a[aria-expanded=false]::after{
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    transition-duration: 0.3s;
}
#accordion_menu a[aria-expanded=true]::after{
    -webkit-transform: rotate(135deg);
    -ms-transform: rotate(135deg);
    transform: rotate(135deg);
    transition-duration: 0.3s;
}
[id^="question"] li{
    padding: 10px 10px 10px 20px;
}

</style>
