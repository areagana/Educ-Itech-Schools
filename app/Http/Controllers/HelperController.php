<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    // only allow authenticated users
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * call user subjects for the term
     */
    public function termSubjects($id)
    {
        $student = User::find($id);
        $date = date('Y-m-d');
        $school = $student->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $subjects = $student->subjects()->where('term_id',$term->id)->get();
        return $subjects;
    }

    /**
     * get subject and exam results for a student
     */
    public function examResults($id,$subject,$exam)
    {
        $student = User::find($id);
        $results = $student->examresults()->where('exam_id',$exam->id)
                                          ->where('subject_id',$subject->id)
                                          ->first();
        return $results;
    }

    /**
     * extract results from the returned array
     */
    public function extractresults($id,$subject,$exam)
    {
        $array = $this->examResults($id,$subject,$exam);
        if($array)
        {
            return $array->marks;
        }else{
            return "";
        }
        
    }

    // get comment from the table
    public function getComment($id,$subject,$exam)
    {
        $array = $this->examResults($id,$subject,$exam);
        if($array)
        {
            $comment = $array->comment;
        }else{
            $comment = "";
        }
        return $comment;
    }

    // grading function
    public function markGrading($mark)
    {
        if($mark > 0)
        {
            if($mark > 0 && $mark <= 34){
                $gd = "F9";
            }else if($mark<=44){
                $gd="P8";
            }else if($mark<=54){
                $gd="P7";
            }else if($mark<=59){
                $gd="C6";
            }else if($mark<=64){
                $gd="C5";
            }else if($mark<=69){
                $gd="C4";
            }else if($mark<=74){
                $gd="C3";
            }else if($mark<=79){
                $gd="D2";
            }else if($mark<=100){
                $gd="D1";
            }
        }else{
            $gd = "X";
        }
        return $gd;
    }

    /**
     * sum marks to get the total
     */
    public function sumMarks($array)
    {
        $sum = array_sum($array);
        return number_format($sum,0);
    }
}
