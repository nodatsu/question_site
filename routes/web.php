<?php

Route::get('/questions', 'QuestionController@index')->name('question.list');
Route::get('/questions/help', 'QuestionController@help')->name('question.help');
Route::get('/question/new', 'QuestionController@create')->name('question.new');
Route::post('/question', 'QuestionController@store')->name('question.store');

Route::post('/question/reply/{id}', 'QuestionController@reply')->name('question.reply');

Route::get('/question/edit/{id}', 'QuestionController@edit')->name('question.edit');
Route::post('/question/update/{id}', 'QuestionController@update')->name('question.update');

Route::get('/question/{id}', 'QuestionController@show')->name('question.detail');
Route::delete('/question/{id}', 'QuestionController@destroy')->name('question.destroy');

Route::get('/reply/interest/{question}', 'QuestionController@interest')->name('interest');
Route::get('/reply/uninterest/{question}', 'QuestionController@uninterest')->name('uninterest');


Route::get('/', function () {
    return redirect('/questions');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
