<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Form;
use App\Models\TimeTable;
use File;

class TimeTableController extends Controller
{
    /**
     * check if the user is authenticated
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * access timetables
     */
    public function index($id)
    {
        $school = School::find($id);
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $timetables = Timetable::distinct()
                                ->where('school_id',$school->id)
                                //->pluck('attachment_name','form_id','start_date','close_date')
                                ->get()
                                ->sortByDesc('id');
        return view('schools.timetables.show',compact(['school','term','timetables']));
    }

    /**
     * create a timetable
     */
    public function create($id)
    {
        $timetable = new Timetable;
        $date = date('Y-m-d');
            if(Auth::user()->hasRole(['superadministrator','administrator']))
            {
                $school = School::find($id);
            }
        $school = Auth::user()->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        return view('schools.timetables.create',compact('term','school'));
    }

    /**
     * upload the attached timetables here
     */
    public function store(Request $request)
    {
        
        $school_id = $request->input('school_id');
        $school = School::find($school_id);
        $term_id = $request->input('term_id');
        $class = $request->input('school_forms');
       
        $files=[];

        if($request->file('file'))
        {
            
           // check if a class has been selected or all classes have been selected
            if($class == 'All')
            {
                // count the files attached
                if(count($request->file('file')) > 1) // if many documents have been attached
                {

                    foreach($request->file('file') as  $file)
                    {
                        $fileName =time().'_'.$file->getClientOriginalName();
                        $file->move(storage_path('app/Timetables'),$fileName);
                        $files[] = $fileName;
                    }
                }else{ // if one document has been attached
                    foreach($request->file('file') as $file)
                    {
                        $fileName = time().'_'.$file->getClientOriginalName();
                        $file->move(storage_path('app/Timetables'),$fileName);
                        $files[] = $fileName;
                    }
                }

                    $timetable = new Timetable();
                    $timetable->school_id = $school->id;
                    $timetable->term_id = $term_id;
                    $timetable->title = $request->input('timetable_title');
                    $timetable->attachment_name = json_encode($files);
                    $timetable->start_date = $request->input('start_date');
                    $timetable->close_date = $request->input('end_date');
                    $timetable->user_id = Auth::user()->id;
                    $timetable->save();

            }else{// if one class has been selected
                // count the files attached
                if(count($request->file('file')) > 1) // if many documents have been attached
                {
                    foreach($request->file('file') as  $file)
                    {
                        $fileName = time().'_'.$file->getClientOriginalName();
                        $file->move(storage_path('app/Timetables'),$fileName);
                        $files[] = $fileName;
                    }
                }else{ // if one document has been attached
                    foreach($request->file('file') as $file)
                    {
                        $fileName = time().'_'.$file->getClientOriginalName();
                        $file->move(storage_path('app/Timetables'),$fileName);
                        $files[] = $fileName;
                    }
                }

                    $form = Form::find($request->input('school_forms'));
                    $timetable = new Timetable();
                    $timetable->school_id = $school->id;
                    $timetable->form_id = $form->id;
                    $timetable->term_id = $term_id;
                    $timetable->title = $request->input('timetable_title');
                    $timetable->attachment_name = json_encode($files);
                    $timetable->start_date = $request->input('start_date');
                    $timetable->close_date = $request->input('end_date');
                    $timetable->user_id = Auth::user()->id;
                    $timetable->save();
            } 

            return redirect()->back()->with('success','Time table has been created');
        }
        echo 'No attachment was selected';
        //return redirect()->back()->with('error','Failure to upload document');
    }

    /**
     * download timetable
     */
    /**
     * download assignment document
     */
    public function downloadTimetable($id)
    {
        $docs =[];
        $timetable = Timetable::find($id);
        $docs[] = json_decode($timetable->attachment_name);

        if(storage_path('app/Timetables').'/'.$docs[0][0])
        {
            $path = storage_path('app/Timetables').'/'.$docs[0][0];
            return response()->download($path);
        }       
    }

    /**
     * view file in page
     */
    public function viewFile($id)
    {
        $docs =[];
        $date = date('Y-m-d');
        $timetable = Timetable::find($id);
        $docs[] = json_decode($timetable->attachment_name);
        $school = $timetable->school;
        $timetables = Timetable::distinct()
                                ->where('school_id',$school->id)
                                //->pluck('attachment_name','form_id','start_date','close_date')
                                ->get()
                                ->sortByDesc('id');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();

        if(storage_path('app/Timetables').'/'.$docs[0][0])
        {
            $path = storage_path('app/Timetables').'/'.$docs[0][0];
            return response()->file($path);
        }       
    }

    /**
     * publi function destroy timetable
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $table = Timetable::find($id);
            $school = $table->school;
            $docs =[];

            $docs[] = json_decode($table->attachment_name);

            if(File::exists(storage_path('app/Timetables').'/'.$docs[0][0]))
            {
                File::delete(storage_path('app/Timetables').'/'.$docs[0][0]);
            }       
            $table->delete();

        }
    }
}
