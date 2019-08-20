<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Teacher;
use App\Student;
use App\User;
use Validator;
use Redirect;
use Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teach=Teacher::join('users','users.id','=','teachers.user_id')->select('teachers.*','users.name','users.email')->get();
        $stud=Student::join('users','users.id','=','students.user_id')->select('students.*','users.name','users.email')->get();
       return view('Admin_home',compact('teach','stud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.add_teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  // Funtion for store teacher
    {
        $data=$request->all();
        $validator= Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'department' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);

        }
         $user=User::create([
            'name' => $request->name,
            'user_type' => 'teacher',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $item = new Teacher;
        $item->user_id= $user->id;
        $item->department= $request->department;
        $item->save();


        $request->session()->flash('success', 'New Record Created Successfully !!');
        return redirect()->action('AdminController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $teacher=Teacher::join('users','users.id','=','teachers.user_id')->select('teachers.id','teachers.department','users.name','users.email','users.id as user_id')->where('teachers.id',$id)->first();
        return view('teacher.edit_teacher',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)   // Funtion for update teacher
    {
        $data=$request->all();

        // validation
        $validator = Validator::make(
                $request->all(),
                array(
                    'name' => ['required', 'string', 'max:255'],
                    'department' => ['required'],
                    'email' => ['required',Rule::unique('users')->ignore($request->user_id)],
                  
                 ));
        if ($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

         $user=User::find($request->user_id);
         $user->name=$request->name;
         $user->email=$request->email;
         $user->update();

        $item = Teacher::find($id);
        $item->department= $request->department;
        $item->update();


        $request->session()->flash('success', 'Update Record Successfully !!');
        return redirect()->action('AdminController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id)
    {
     $teacher=Teacher::find($teacher_id);
     $teacher->delete();
        return redirect()->action('AdminController@index')->with('success', 'Delete Teacher Successfully !!');
    }
}
