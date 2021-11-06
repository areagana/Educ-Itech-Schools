
// function to close parent div for buttons
function closeParent4()
{
    $(this).parent().parent().parent().parent().hide();
}
function closeParent3()
{
    $(this).parent().parent().parent().hide();
}
// 2 parents
function closeParent2()
{
    $(this).parent().parent().hide();
}

// single parent
function closeParent()
{
    $(this).parent().hide();
}

/**
 * print page contents
 */
 function printPage(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}


$('.close-session-msg').on('click',function(){
    $(this).parent().parent().parent().hide();
});

//show more links
function ShowMore(id)
{
    $('#'+id).show();
}

//function close
function Close(cls)
{
    $('.'+cls).hide();
}

// show div
function ShowDiv(cls)
{
    $('.'+cls).show();
}
// hide if not clicked
$(document).mouseup(function(e) 
{
    var container = $(".more");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});


     // show password toggle
     function ShowPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

// delete user function
function deleteUser(id)
{
    $.ajax({
        url:"user/delete",
        data:{
            id:id
        },
        success:function(res){
            xdialog.alert('User deleted successfully');
        }
    });
}

// delete user function
function deleteRecord(id,link,redirect)
{
    $.ajax({
        url:link,
        data:{
            id:id
        },
        success:function(res){
            xdialog.alert('Record deleted successfully');
            window.location= redirect;
        }
    });
}

// delete user function
function deleteItem(id,link)
{
    $.ajax({
        url:link,
        data:{
            id:id
        },
        success:function(res){
            xdialog.alert('Record deleted successfully');
            if(res.link !='')
            {
                window.location = res.link;
            }
        }
    });
}
//// delete user function
function deleteChild(parentid,childid,link,redirect)
{
    $.ajax({
        url:link,
        data:{
            parent:parentid,
            child:childid
        },
        success:function(res){
            window.location= redirect;
            xdialog.alert('Record deleted successfully');
        }
    });
}


// show something when you click on the school
$(document).on('click','.school-id',function(){
    var id = $(this).val();
    $('.school-courses').show();
    $('.new-school-course').hide();
    $('#new_course_school_id').val(id);
    SchoolFind(id);    
});

// function to find school
function SchoolFind(id)
{
    $.ajax({
        url:'/school/find',
        data:{
            id:id
        },
        dataType:'json',
        beforeSend:function(){
            $('.school-course-list').html("Loading...");
        },
        success:function(res){
            var school_name ="";
            var list ="";
            var lists ="";
            if(res.courses!=""){
                $.each(res.courses,function(index,course){
                    list += "<li class='header'>"+course.course_name+
                    "<span class='right'><i class='fa fa-edit' onclick=''></i> <i class='fa fa-trash' onclick=''></i></span>"+
                    "</li>";
                });
                $('.school-course-list').html(list);
            }else{
                $('.school-course-list').html('add courses');
            }
            
            $('.school-name').html(res.schools.school_name+" Courses <span class='right'><i class='fa fa-plus btn btn-circle btn-info shadow-sm add-school-course'></i></span>");
            $('#school_code').val(res.schools.school_code);
        }
    });
}


$(document).on('click','.school_course_subjects',function(){
    var id = $(this).val();
    $('.school-courses').show();
    $('.new-school-course').hide();
    $('#searchme').val("");
    CourseFind(id);    
});
// function to find school
function CourseFind(id)
{
    $.ajax({
        url:'/course/find',
        data:{
            id:id
        },
        dataType:'json',
        beforeSend:function(){
            $('.school-course-subject-table').html("Loading...");
        },
        success:function(res){
            var course_name ="";
            var list ="";
            //var lists ="";
            if(res.subjects!=""){
                $.each(res.course_subjects,function(index,subject){
                    list += "<tr>"+
                                "<td>"+subject.id+"</td>"+
                                "<td>"+subject.subject_code+"</td>"+
                                "<td>"+subject.subject_name+"</td>"+
                                "<td>"+subject.users+"</td>"+
                                "<td>"+
                                    "<i class='fa fa-plus btn btn-light btn-sm' onclick='addSubjectUser("+subject.id+")' id='"+subject.id+"'></i>"+
                                    "<i class='fa fa-edit btn btn-light btn-sm' onclick='' id='"+subject.id+"'></i>"+
                                "</td>"+
                            "</tr>";
                });
                $('.school-course-subject-table').html(list);
                $('.course-subjects').html("("+res.course_subjects.length+")");

            }else{
                $('.school-course-subject-table').html("<tr><td colspan='5'>NO subjects. Please Add</td></tr>");
            }
        }
    });
}

// show a form to add school courses
$(document).on('click','.add-school-course',function(){
    $('.new-school-course').show();
});

//append div to a div to create school courses
var div ="<div class='form-group p-2 border-bottom new-course'>"+
            "<label for ='' class='form-label'>"+
                "Course Code"+
                "<input type='text' class='custom-input code' name='course_code[]'>"+
            "</label>"+
            "<label for='' class='form-label'>"+
                "Course Name"+
                "<input type='text' class='custom-input' name='course_name[]'>"+
            "</label>"+
            "<i class='fa fa-minus right btn btn-sm btn-danger remove-course' title='Remove Course'></i>"+
          "</div>";

$(document).on('click','#new-div',function(){
    var code = $('#course_code').val();
    $('.new-course-list').append(div);
    $('.code').val(code);
});

/**
 * hide the new course form
 */
$(document).on('click','.remove-course',function(){
    $(this).parent().hide();
});

// add subject user to class
function addSubjectUser(id)
{
    //console.log(id);
    alert('Add subject users to course id:'+id);
}

/**
 * function to search items
 */
 function SearchItem(id,id2,section)
 {
    var value = $('#'+id).val().toLowerCase();
    $("#"+id2+" "+section).filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });      
 }

 function LocateStudents(school_id,class_id,text)
 {
    $.ajax({
        url:'/form/students',
        data:{
            school_id:school_id,
            class_id:class_id
        },
        beforeSend:function(){
            var thed ="";
            thed = "<tr>"+
                        "<th><input type='checkbox' id='Check_all'></th>"+
                        "<th>Student Name</th>"+
                        "<th>Student Id</th>"+
                        "<th>Email</th>"+
                    "</tr>";
            $('#student-table-thead').html(thed);
            $('#school-students').html('Loading...');
        },
        success:function(res){
            console.log(res);
            var row="";
            if(res.students.data.length>0)
            {
                $.each(res.students.data,function(index,student){
                    row+="<tr>"+
                            "<td><input type='checkbox' name='school-student[]' value='"+student.id+"'></td>"+
                            "<td>"+student.firstName+" "+student.lastName+"</td>"+
                            "<td>"+student.id+"</td>"+
                            "<td>"+student.email+"</td>"+
                        "</tr>";
                });
            }else{
                row ="<tr><td colspan='4'><b><i>No students enrolled for this class</i></i></b></td></tr>";
            }
                $('#school-students').html(row);
                $('.pagination').html(res.paginate);
                $('.form-student-title').show();
                $('.form-student-title').html("<h6>Category: Students;&nbsp;&nbsp; <span class='right'>Class: "+text+"</span></h6>");            
        }
    });
 }

 $(document).on('change','#user-category',function(){
    var value = $(this).val();
    if(value =='Student')
    {
        $('.student-class').show();
    }else{
        $('.student-class').hide();
    }
 });

 /**
  * filter members
  */

 function FilterMembers(id,subject)
 {
    var value = $('#'+id).val();
    $.ajax({
        url:'/members/filter',
        data:{
            role:value,
            subject:subject
        },
        dataType:'json',
        beforeSend:function(){
            $('#subject-people').html("<tr><td colspan='5'>Fetching...</td></tr>");
        },
        success:function(res){
            var row = "";
            $.each(res.data,function(index,member){
                row+=
                "<tr>"+
                    "<td>"+member.id+"</td>"+
                    "<td><a href='' class='nav-link'>"+member.firstName+" "+member.lastName+"</a></td>"+
                    "<td>"+member.email+"</td>"+
                    "<td>"+member.roles[0].name+"</td>"+
                "</tr>";
            });
            $('#subject-people').html(row);
            console.log(res);
        },
        error:function(){
            $('#subject-people').html("<tr><td colspan='5'><i><h4>No results found</h4></i></td></tr>");
        }
    });
 }

 /**
  * add more attachmentns
  */
 function AddFileAttach()
 {
     var input = "<input type='file' name='assignment_attachment[]' class='form-control my-1'>";
     $('.add-attachment').append(input);
 }

 $(document).on('change','#submission_list',function(){
    var id = $(this).val();
    alert(id);
    fetchSubmittedAssignment(id);
 });

 /**
  * function to fetch assigment submission for the seected user
  */
 function fetchSubmittedAssignment(assignment,user)
 {
    $.ajax({
        url:'/assignment/'+assignment+'/load',
        data:{
            user_id:user,
        },
        beforeSend:function(){
            $('.assignment-displayed').html('Loading...');
        },
        success:function(res){

            var attachment ="";
            attachment ="<option value=''>Select</option>";

            $.each(res.attached[0],function(index,attach){
                attachment +="<option value='"+attach+"'>"+attach+"</option>";
            });
            
            var sub_id ="";
            var grade ="";
            $.each(res.data,function(index,sub){
                sub_id = sub.id;
                if(sub.submitted_grade !='')
                {
                    grade = sub.submitted_grade;
                }
            });
            $('#submission_id').val(res.sub_id);
            $('#user-attachments').html(attachment);
            $('.graded').html(grade);
            $('#assigned_grade').val(grade);
        }
    });
 }

 function loadAttachment(id)
 {
     $('.assignment-displayed').html("<embed src='/storage/app/Assignments/Submitted/"+id+"'><embed>");
     //$('.assignment-displayed').html("<iframe src='"+generatePDF('/storage/app/Assignments/Submitted/'+id)+"'</iframe>");
     
 }

 function submitGrade(value,max,submission)
 {
     if(value > max){
         xdialog.alert('Grade cannot be greater than maximum value');
         return;
     }else{
         
         $.ajax({
             url:'/submission/grade/save',
             data:{
                grade:value,
                submission:submission
             },
             success:function(res){
                console.log('success');
             }
         });
     }
 }

 /**
  * save comment
  */
 function saveComment(comment,submission)
 {
    if(comment !="")
    {
        $.ajax({
            url:'/submission/comment/save',
             data:{
                comment:comment,
                submission:submission
             },
             success:function(res){
                 
                 if(res.comments.length > 0)
                 {
                     console.log(res);
                     $('#assigned_comment').val("");
                     var comm ="";
                     $.each(res.comments,function(index,comment){
                        comm+="<div class='comment p-2 my-1'>"+comment.comment+"</div>";
                     });
                    $('.submission-comments').html(comm);
                 }
             }
        });
    }
 }

/**
 * convert document to pdf
 */
 function generatePDF(document) {
    html2pdf().from(document).save();
}

/**
 * change color for a module
 */
function ModuleColor(color,module)
{
    $.ajax({
        url:'/module/update',
        data:{
            color:color,
            module:module
        },
        success:function(res)
        {
            if(res.link)
            {
                window.location = res.link;
            }
        }
    });
}

/**
 * add a draggable class to assignments
 */
 $('.draggable').draggable();
 $('.term-notice').fadeOut(1000);