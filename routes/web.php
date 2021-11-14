<?php

Route::get('/questions', 'QuestionController@index')->name('question.list');
Route::get('/question/{id}', 'QuestionController@show')->name('question.detail');

Route::get('/', function () {
    return redirect('/questions');
});