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
function userCourseWorkMarks($user,$topic)
{
    $results = $user->courseworks()->where('topic_id',$topic->id)
                                  ->get();
    $marks =[];
    foreach($results as $result)
    {
        $marks[] = $result->marks;
    }
    return $marks;
}


function gradeMark($mark)
{
    $scale=[
        ['min'=>'','max'=>'','GD'=>''],
        ['min'=>0,'max'=>34,'GD'=>'F9'],
        ['min'=>35,'max'=>44,'GD'=>'P8'],
        ['min'=>45,'max'=>54,'GD'=>'P7'],
        ['min'=>55,'max'=>59,'GD'=>'C6'],
        ['min'=>60,'max'=>64,'GD'=>'C5'],
        ['min'=>65,'max'=>69,'GD'=>'C4'],
        ['min'=>70,'max'=>74,'GD'=>'C3'],
        ['min'=>75,'max'=>79,'GD'=>'D2'],
        ['min'=>80,'max'=>100,'GD'=>'D1'],
    ];

    foreach($scale as $array)
    {
        if($mark >= $array['min'] && $mark <= $array['max'])
        {
            return $array['GD'];
        }
    }
}