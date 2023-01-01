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

function gradeMarkValue($mark,$school)
{
    if($school->gradings()->count() > 0){
        foreach($school->gradings as $array)
        {
            if($mark >= $array->min_value && $mark <= $array->max_value && $mark != null && $mark !='')
            {
                return $array->grade_value;
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
            return $result;
        }
    }
}

// get results for suubjects with papers
function examMarksPapers($results,$subject,$pap)
{
    global $school;
    $subjects =[];
    foreach($results as $result)
    {
        $subjects[] = $result->subject;
    }

    return $subjects;
}

function resultSubjects($results)
{
    // global $school;
    $subjects =[];
    foreach($results as $result)
    {
        $subjects[] = $result->subject;
    }

    return array_unique($subjects);
}

// get paper exam results
function paperResults($results,$paper)
{
    foreach($results as $result)
    {
        if($result->paper == $paper)
        {
            return $result;
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

// level grading
function divisionGrading()
{
    $olevel =[
        'DIV 1' => [
            'done'=>8,
            'passed'=>8,
            'aggregates'=>32,
            'distinctions'=>4,
            // credits and distinctions
            'better_grades'=>7,
            'credits'=>3,
            // atleast one science at credit level
            'sciences'=>[
                '553'=>6,
                '545'=>6,
                '454'=>6
            ],
            // humanity subjects geog and history
            'humanities'=>[
                '203'=>6,
                '200'=>6
            ],
            //english and maths
            'factors'=>[
                '225'=>6,
                '444'=>8
            ],
            // mandatory subjects that must have marks for grading to occur
            'compulsories'=>[
                '553','545','454','203','200','225','444'
            ]
        ],
        'DIV 2'=> [
            'done'=>8,
            'passed'=>8,
            'aggregates'=>45,
            'distinctions'=>2,
            // credits and distinctions
            'better_grades'=>6,
            'credits'=>2,
            // atleast one science at credit level
            'sciences'=>[
                '553'=>8,
                '545'=>8,
                '454'=>8
            ],
            
            //english and maths
            'factors'=>[
                '225'=>8
            ],
            // mandatory subjects that must have marks for grading to occur
            'compulsories'=>[
                '553','545','454','203','200','225','444'
            ]
        ],
        'DIV 3'=>[
            'done'=>8,
            'passed'=>8,
            'aggregates'=>58,
            // credits and distinctions better grades
            'options'=>[
                [
                    'better_grades'=>3,
                    'passes'=>8
                ],
                [
                    'better_grades'=>4,
                    'passes'=>7
                ],
                [
                    'better_grades'=>5
                ]

            ],
            // mandatory subjects that must have marks for grading to occur
            'compulsories'=>[
                '553','545','454','203','200','225','444'
            ]
        ],
        'DIV 4'=>[
            'done'=>8,
            'aggregates'=>68,
            // credits and distinctions better grades
            'options'=>[
                [
                    'better_grades'=>3,
                    'passed'=>8
                ],
                [
                    'better_grades'=>4,
                    'passed'=>7
                ],
                [
                    'better_grades'=>5
                ]

            ],
            // mandatory subjects that must have marks for grading to occur
            'compulsories'=>[
                '553','545','454','203','200','225','444'
            ]
        ],
        'DIV 9'=>[
            'done'=>8,
            'aggregates'=>72,
            // mandatory subjects that must have marks for grading to occur
            'compulsories'=>[
                '553','545','454','203','200','225','444'
            ]
        ],
        'DIV 7'=>[
            'done'=>7
        ]
    ];
}