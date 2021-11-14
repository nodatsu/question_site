<?php

Route::get('/questions', 'QuestionController@index')->name('question.list');

Route::get('/', function () {
    return redirect('/questions');
});