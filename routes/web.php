<?php

Route::get('/questions', 'QuestionController@index')->name('question.list');
Route::get('/question/new', 'QuestionController@create')->name('question.new');
Route::get('/question', 'QuestionController@store')->name('question.store');



Route::get('/question/{id}', 'QuestionController@show')->name('question.detail');

Route::get('/', function () {
    return redirect('/questions');
});