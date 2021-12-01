<?php

namespace App\Http\Controllers;

use App\Question;
use App\Category;
use App\Reply;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','help', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('index', ['questions' => $questions]);
    }
    public function help()
    {
        $questions = Question::all();
        return view('help', ['questions' => $questions]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question;
        $categories = Category::all()->pluck('name', 'id');
        return view('new', ['question' => $question, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $user = \Auth::user();
        
        $question->title = request('title');
        $question->question_content = request('question_content');
        $question->category_id = request('category_id');
        $question->user_id = $user->id;
        $question->save();
        return redirect()->route('question.detail', ['id' => $question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $question = Question::find($id);
        $replies = $question->replies;
        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }

        return view('show', ['question' => $question,'replies'=> $replies, 'login_user_id' => $login_user_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $categories = Category::all()->pluck('name', 'id');
        return view('edit', ['question' => $question, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,Question $question)
    {
        $question = Question::find($id);
        $question->title = request('title');
        $question->question_content = request('question_content');
        $question->category_id = request('category_id');
        $question->save();
        return redirect()->route('question.detail', ['id' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect('/questions');
    }
    
    public function reply(Request $request, $id)
    {
        $reply = new Reply;
        
        $reply->question_reply = request('question_reply');
        $reply->question_id = $id;
        $reply->save();
        
        $question = Question::find($id);
        $replies = $question->replies;
        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }
        
        //return redirect()->route('question.detail',['id' => $id]);
        return view('show', ['question' => $question,'replies'=> $replies, 'login_user_id' => $login_user_id]);
    }
}
