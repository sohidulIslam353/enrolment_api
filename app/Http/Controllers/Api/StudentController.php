<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Student;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student=DB::table('students')->get(); //query builder
       // $student=Student::all() //eloquent
        return response()->json($student);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=array();
        $data['class_id']=$request->class_id;
        $data['section_id']=$request->section_id;
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['password']=Hash::make($request->password);
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['photo']=$request->photo;
        DB::table('students')->insert($data);
        return response('inserted');

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=DB::table('students')->where('id',$id)->first();
       // $student=Student::findorfail($id);
        return response()->json($student);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=array();
        $data['class_id']=$request->class_id;
        $data['section_id']=$request->section_id;
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['password']=Hash::make($request->password);
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['photo']=$request->photo;
        DB::table('students')->where('id',$id)->update($data);
        return response('Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img=DB::table('students')->where('id',$id)->first(); //get the data
        $image_path=$img->photo; //get only image

        unlink($image_path); //image deleted from folder
        DB::table('students')->where('id',$id)->delete(); //data deleted from database
        return response('deleted'); //response

       
    }
}
