<?php

namespace App\Http\Controllers;

use App\Question;
use App\Category;
use App\Reply;
use App\Interest;
use App\Good;

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
    public static function index()
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
    public function show($id,Request $request)
    {
        $question = Question::find($id);
        $reply = Reply::find($id);
        $replies = $question->replies;
        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
            $interest = Interest::where('question_id', $question->id)->where('user_id',$login_user_id)->first();
            $good = Good::where('reply_id', $reply->id)->where('user_id',$login_user_id)->first();
        } else {
            $login_user_id = "";
        }

        return view('show', compact('question','interest'),['question' => $question,'replies'=> $replies, 'login_user_id' => $login_user_id]);
        
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
        
        $user = \Auth::user();
        $reply->question_reply = request('question_reply');
        $reply->question_id = $id;
        $reply->user_id = $user->id;
        $reply->save();
        
        $question = Question::find($id);
        $replies = $question->replies;
        
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }
        
        return view('show', ['question' => $question,'replies'=> $replies, 'login_user_id' => $login_user_id ]);
    }
    public function interest(Question $question, Request $request){
        $interest=new Interest();
        $interest->question_id=$question->id;
        $interest->user_id=\Auth::user()->id;
        $interest->save();
        return back();
        
    }
    public function uninterest(Question $question, Request $request){
        
        $user=\Auth::user()->id;
        $interests=Interest::where('question_id', $question->id);
        $interests->where('user_id',$user)->first()->delete();
        return back();
    }
    
    public function good(Reply $reply,Request $request){
        
        $good =new Good();
        $good->reply_id=$reply->id;
        $good->user_id=\Auth::user()->id;
        $good->save();
        return back();
    }
     public function ungood(Reply $reply, Request $request){
        
        $user=\Auth::user()->id;
        $goods=Good::where('reply_id', $reply->id);
        $goods->where('user_id',$user)->first()->delete();
        return back();
    }
}
