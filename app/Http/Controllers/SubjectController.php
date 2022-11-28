<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Dashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //$id = decrypt($ID);
        $user = Auth::user();
        if($user->hasRole(['superadministrator','administrator']))
        {
            $school = School::find($id);
            $subjects = $school->subjects()->paginate(10);
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();

        }elseif($user->hasRole(['ict-admin','school-administrator']))
        {
            $school = $user->school;
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
            if($term)
            {
                $subjects = $school->subjects()->paginate(10);
            }else{
                $subjects = "";
            }
        }
        return view('subjects.index',compact(['school','subjects','term']));
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
        $subject = new Subject();
        $subject->level_id = $request->input('subject_level');
        $subject->school_id = $request->input('school_id');
        $subject->short_name = $request->input('short_name');
        $subject->papers = $request->input('subject_papers');
        $subject->subject_name = $request->input('subject_name');
        $subject->subject_code = $request->input('subject_code');
        $subject->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $date = date('Y-m-d');
        $user = Auth::user();
        $term = $user->school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        $subjects = $user->subjects();
        // check if the term is not set and return an empty array
               
        return view('subjects.show',compact(['subjects','term','user','subjects']));
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
     * enroll students into a subject
     */
    public function enrollStudents($id)
    {
        
        $subject = Subject::find($id);
        $school = $subject->school;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        $students = $school->students()->where('year',date('Y'))->orderBy('firstname')->get();
        return view('subjects.subject_enroll',compact(['subject','school','students','term']));
    }

    /**
     * enroll students into a subject
     */
    public function enrollStudentsstore(Request $request)
    {
        $id = $request->input('subject_id');
        $form_id = $request->input('school_form');
        $stream = $request->input('form_stream');
        $subject = Subject::find($id);
        $school = $subject->school;
        $students = $request->input('selected_student');
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();

        
        $subject->students()->attach($students,['year'=>date('Y'),'form_id'=>$form_id,'stream_id'=>$stream,'term_id'=>$term->id,'user_id'=>Auth::user()->id]);
        // foreach($students as $sid)
        // {
        //     $student = Student::find($sid);
        //     $student->subjects()->attach($subject,['year'=>date('Y'),'form_id'=>$student->form->id,'term_id'=>$term->id,'user_id'=>Auth::user()->id]);
            
        // }
        return redirect()->route('subjectMembers',$subject->id);
    }

    /**
     * mass enroll students into a subject
     */
    public function massEnroll(Request $request)
    {
        if($request->ajax())
        {
            $list = $request->list;

            $subject_id = $request->subject;
            $year = $request->year;
            $form_id = $request->form_id;
            $stream_id = $request->stream_id;
            $term_id = $request->term_id;

            //get the subject where to enroll students
            $subject = Subject::find($subject_id);

            // eliminate
            // foreach($list as $id){
            //     $student = Student::find($id);
            //    $data = $subject->students()->updateOrCreate(
            //         ['student_id'=>$student->id,'form_id'=>$form_id,'year'=>$year],
            //         ['stream_id'=>$stream_id,'term_id'=>$term_id,'user_id'=>Auth::user()->id]
            //     );
            // }
            // attach all users to the subject
            $subject->students()->attach($list,['form_id'=>$form_id,'stream_id'=>$stream_id,'term_id'=>$term_id,'year'=>$year,'user_id'=>Auth::user()->id]);
            return response()->json(['success'=> count($list).' Students have been enrolled into '.$subject->subject_name]);
        }
    }

    /**
     * get subject members
     */
    public function members($id)
    {
        $user = Auth::user();
        if($user->hasRole(['superadministrator','administrator']))
        {
            $subject = Subject::find($id);
            $school = $subject->school;
        }else if($user->hasRole(['ict-admin','school-administrator']))
        {
            $subject = Subject::find($id);
            $school = $subject->school;
        }
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        return view('subjects.members',compact(['subject','school','term']));
    }

    /**
     * get subject details for the user
     */
    public function subjectDetails($id)
    {
        //$id = decrypt($ID);
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $date = date('Y-m-d');
        $upcoming = $subject->assignments()->whereDate('end_date','>=',$date)->get();
        $previous = $subject->assignments()->whereDate('end_date','<',$date)->get();
        if(Auth::user()->hasRole(['student']))
        {
            $pendings =[];
            foreach($subject->assignments as $assignment)
            {
                // assignment submissions where user id is not available
                $check = $assignment->assignment_submissions->where('user_id',Auth::user()->id);
                if($check->count() == 0)
                {
                    $pendings[] = $assignment;
                }
            }
            if(!$previous)
            {
                $previous =[];
            }
            return view('subjects.view',compact(['subject','upcoming','previous','pendings','card']));
        }
        return view('subjects.view',compact(['subject','upcoming','previous','card']));
    }

    /**
     * functions to access subject content
     */
    public function people($id)
    {
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $form = $card->form;
        $members = $subject->users()->wherePivot('form_id',$form->id)->get();
        $school = $subject->school;
        return view('subjects.people.index',compact(['subject','members','school','card']));
    }

    /**
     * notes
     */
    public function notes($id)
    {   
        $subject = Subject::find($id);
        $modules = $subject->modules;
        return view('subjects.notes.index',compact(['modules','subject']));
    }

    /**
     * grades
     */
    public function grades($id)
    {
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $form = $card->form;

        if(Auth::user()->hasRole('student'))
        {
            $assignments = $subject->assignments()->where('form_id',$form->id)->get();
            $total_points = $assignments->sum('total_points');
            $total_marks = Auth::user()->assignment_submissions()->sum('submitted_grade');
            if($total_points ==0)
            {
                $total_points =1;
            }
            return view('subjects.grades.studentGrade',compact(['subject','assignments','total_points','total_marks','card','form']));
        }else{
            return view('subjects.grades.gradebook',compact(['subject','card','form']));
        }
    }

    /**
     * conferences
     */
    public function conferences($id)
    {
        $card = Dashcard::find($id);
        $subject = $crad->subject;
        $form =  $card->form;
        $conferences = $subject->conferences;
        $upcoming = $subject->conferences()->where('status','Set')->get();
        $concluded = $subject->conferences()->where('status','Ended')->get();
        $active = $subject->conferences()->where('status','active')->get();
        return view('subjects.conferences.index',compact(['subject','conferences','upcoming','concluded','active','card','form']));
    }

    /**
     * Announcememts
     */
    public function announcements($id)
    {
        
    }

    /**
     * files
     */
    public function files($id)
    {
        
    }

    /**
     * assessments
     */
    public function assessment($id)
    {
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $form = $card->form;
        $date = date('Y-m-d');
        $school = $subject->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $termExams = $term->exams;
        $students = $subject->users()->whereRoleIs('student')->get();
        if(Auth::user()->hasRole(['teacher']))
        {
            return view('subjects.assessments.teacher',compact(['subject','school','term','termExams','students','card','form']));
        }else if(Auth::user()->hasRole(['student'])){
            return view('subjects.assessments.student',compact(['subject','school','term','termExams','card','form']));
        }
       
    }   

    /**
     * filter subject members
     */
    public function filterMembers(Request $request)
    {
        if($request->ajax())
        {
            $role = $request->role;
            if($role !='All')
            {
                $subject_id = $request->subject;
                $subject = Subject::find($subject_id);
                $members = $subject->users()->whereRoleIs($role)->get();
            }else{
                $subject_id = $request->subject;
                $subject = Subject::find($subject_id);
                $members = $subject->users;
            }
            $roles=[];
            foreach($members as $member)
            {
                $roles = $member->roles;
            }
            return response()->json(['data'=>$members]);
        }
    }

}
