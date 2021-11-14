<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>質問箱 -青森大学質問投稿サイト-</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>質問一覧</h1>

        @foreach ($questions as $question)
            <p>
                {{ $question->category->name }},
                {{ $question->title}},
                {{ $question->question_content}}
            </p>
        @endforeach
    </body>
</html>
