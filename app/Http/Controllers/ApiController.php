<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\Message;

class ApiController extends Controller
{
   public function getReplyHistory(Request $request)
   {
   	  $id=Student::where('user_id',$request->user_id)->pluck('id')->first();
   	  $techid=$request->teacher_id;

   	  $reply=Message::where('teacher_id',$techid)->where('student_id',$id)->where('status',1)
   	  				 ->leftJoin('teachers','teachers.id','=','messages.teacher_id')	
   	  				 ->leftJoin('users','teachers.user_id','=','users.id')	
   	  				 ->select('messages.*','users.name')	
   	  				 ->get();

   		return response()->json($reply);
   }
}
