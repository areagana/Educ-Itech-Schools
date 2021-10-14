<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\School;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $courses = $school->courses;
        return view('schools.courses.index',compact(['school','courses']));
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
        
        $school_id = $request->input('school_id');
        $course_codes = $request->input('course_code');

        for($i=0;$i< count($course_codes);$i++)
        {
            $course = new Course();
            $course->course_code = $course_codes[$i];
            $course->course_name = $request->input('course_name')[$i];
            $course->school_id = $school_id;
            $course->save();
        }

        return redirect()->back()->with('success','Courses Added to the School');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * find the subjects for the course
     */

     public function SubjectFind(Request $request)
     {
         if($request->ajax())
         {
             $id = $request->id;
             $course = Course::find($id);
             $subjects = $course->subjects;
             return response()->json(['course_subjects'=>$subjects]);
         }
     }

     /**
      * subjects
      */
      public function subjects(Request $request)
      {
          $id = $request->input('course_id');
          $course = Course::find($id);
          return view('subjects.create',compact(['course']));
      }
}
