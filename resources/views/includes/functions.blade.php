<?php

use App\Models\Coursework;

function dateFormat($date,$format)
{
    $date = date_create($date);
    $date = date_format($date,$format);
    return $date;
}

function userExamMarks($student,$exam,$subject)
{
    $results = $student->examresults()->where('exam_id',$exam->id)->get();
    $marks =[];
    foreach($results as $result)
    {
        if($result->subject_id == $subject->id)
        {
            return $result->marks;
        }
    }
}

// generate user exam results for each paper
function userExamPaperMarks($student,$exam,$subject,$paper=false)
{
    $results = $student->examresults()->where('exam_id',$exam->id)->get();
    foreach($results as $result)
    {
        if($paper){
            if($result->subject_id == $subject->id && $result->paper_id == $paper->id)
            {
                return $result->marks;
            }
        }else{
            if($result->subject_id == $subject->id && !$paper)
            {
                return $result->marks;
            }
        }
    }
}

function average($array)
{
    $array = array_filter($array);
    if(count($array) > 0) // only get average when the array has data
    {
        $sum = array_sum($array);
        $total = count($array);
        $average = $sum / $total ;
    }else{
        $average = 0;
    }
    return number_format($average,1);
}

/**
 * claculate percentage for the grades
 */
function gradePercentage($arrayMark,$arrayPoints)
{
    $marks = array_sum($arrayMark);
    $points = array_sum($arrayPoints);
    // check the sum
    if(count($arrayPoints)==0)
    {
        $points =1;
    }
    $age = $marks / $points;
    $age = $age * 100;
    return $age;
}

// get assignment percentage
function assignmentAge($points,$total)
{
    $age = $points / $total * 100;
    return number_format($age,0);
}
/**
 * 
 * testing a function to read files
 */
function readMe($file)
{
    // open file
    $myfile = fopen($file,'r');
    //read file
    return fread($myfile,filesize($file)); // read the complete file
}

//function to check the comment from the database
function comment($comm)
{
    if(!$comm)
    {
        $comment = "Empty comment from the database";
    }else{
        $comment = $comm;
    }
    return $comment;
}

// course works
function userCourseWorkMarks($student,$topic)
{
    $results = $student->courseworks()->where('topic_id',$topic->id)->get();
    $marks =[];
    foreach($results as $result)
    {
        $marks[] = $result->marks;
    }
    return $marks;
}


function gradeMark($mark,$school)
{
    if($school->gradings()->count() > 0){
        foreach($school->gradings as $array)
        {
            if($mark >= $array->min_value && $mark <= $array->max_value && $mark != null && $mark !='')
            {
                return $array->grade;
            }
        }
    }else{
        return '';
    }
}

// get exam marks for a student
function examMarks($results,$subject)
{
    global $school;
    foreach($results as $result)
    {
        if($result->subject == $subject)
        {
            return $result->marks;
        }
    }
}

function commentMark($mark)
{
    $comments =[
        1 =>"Poor performance. Add more effort next time to do better.",
        2 => 'Please Improve',
        3 => 'Add more effort',
        4 => 'You can do even better',
        5 => 'You have tried. Add more effort.',
        6 => 'You have done well.',
        7 => 'You have capacity. Add more.',
        8 => 'You deserve congratulations. You have capacity to get the best grades possible. Keep doing what is right.',
        9 => 'Excellent performance. Please use the time available to keep what you have made'
    ];
    if($mark !=''){
        if($mark > 0 && $mark <=34){
            return $comments[1];
        }elseif($mark <= 54){
            return $comments[2];
        }elseif($mark <= 59){
            return $comments[2];
        }elseif($mark <=64){
            return $comments[4];
        }elseif($mark <=69){
            return $comments[4];
        }elseif($mark <=74){
            return $comments[5];
        }elseif($mark <=79){
            return $comments[6];
        }elseif($mark <=84){
            return $comments[7];
        }elseif($mark <=89){
            return $comments[8];
        }else{
            return $comments[9];
        }
    }else{
        return '';
    }
}