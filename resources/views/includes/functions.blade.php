<?php

function dateFormat($date,$format)
{
    $date = date_create($date);
    $date = date_format($date,$format);
    return $date;
}

function userExamMarks($array)
{
    if($array->count() > 0)
    {
        $marked = [];
        foreach($array as $key => $data)
        {
            $marked[] = $data->marks;
            $marked[] = comment($data->comment);
        }

        if(empty($marked))
        {
            $marked =['x-missing','No comment'];
        }
        $marks = array_filter($marked);
    }else{
        $marks = ['X','No comment'];
    }
    return $marks;
}

function average($array)
{
    if(count($array) > 0) // only get average when the array has data
    {
        $sum = array_sum($array);
        $total = count($array);
        $average = $sum / $total ;
    }else{
        $average = 0;
    }
    return $average;
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