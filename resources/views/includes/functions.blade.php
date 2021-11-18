<?php

function dateFormat($date,$format)
{
    $date = date_create($date);
    $date = date_format($date,$format);
    return $date;
}

function userExamMarks($array)
{
    $marks = [];
    foreach($array as $key=>$data)
    {
        if($data->marks != null)
        {
            $marks[] = $data->marks;
            $marks[] = $data->comment;
        }else{
            $marks[] = "X-Missing";
            $marks[] = "No comment";
        }
    }
    $marks = array_filter($marks);
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