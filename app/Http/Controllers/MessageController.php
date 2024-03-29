<?php

namespace App\Http\Controllers;

use App\Message;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Student::where('user_id',$request->stud_id)->pluck('id')->first();
        $message=new Message();
        $message->teacher_id=$request->tech_id;
        $message->student_id=$id;
        $message->message=$request->message;
        $message->save();

         $request->session()->flash('success', 'Message Send Successfully !!');
        return redirect()->action('StudentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id=Teacher::where('user_id',$request->user_id)->pluck('id')->first();
        $message=Message::find($request->msg_id);
        $message->reply=$request->message;
        $message->status='1';
        $message->update();

         $request->session()->flash('success', 'Reply Send Successfully !!');
        return redirect()->action('StudentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
