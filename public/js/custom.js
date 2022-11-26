
/**
 * activate datatables for the tables in the system
 */
 $(document).ready( function () {
    $('.data-table').DataTable();
    $('table').DataTable();
    $('#dataTable').DataTable();
} );

// loading spinners
var myVar;

function pageloaderfunction() {
 myVar = setTimeout(showPage, 1000);
}

function showPage() {
    document.getElementById("spinners-div").style.display = "none";
    //document.getElementById("myDiv").style.display = "block";
}

$(document).on('click','.nav-link',function(){
    pageloaderfunction()
});

    setTimeout(hideMessage,5000);
//hide success message
    function hideMessage()
    {
        var message = $('.success-alert-message');
        message.fadeOut();
    }


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

    // hide side nav if clicked outside
    var nav = $('.side-nav');
    if (!nav.is(e.target) && nav.has(e.target).length === 0) 
    {
        nav.hide();
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
    
    // show all passwords to check and confrm
    // show password toggle
    function ShowPasswords() {
        var x = document.getElementById("password");
        var y = document.getElementById('confirm-password');
        if (x.type === "password" || y.type==='password') {
          x.type = "text";
          y.type = 'text';
        } else {
          x.type = "password";
          y.type='password';
        }
    }

    // show password on users bulk upload
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });

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
            window.location.reload(true);
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
                                "<td>"+subject.form.form_code+"</td>"+
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

 function SearchItemClass(id,id2,section)
 {
    var value = $('#'+id).val().toLowerCase();
    $("#"+id2+" "+'.'+section).filter(function() {
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
            thed =  "<th><input type='checkbox' id='Check_all' onclick='toggle(this)'></th>"+
                        "<th>Student Name</th>"+
                        "<th>Student Id</th>"+
                        "<th>Email</th>";
                    //"</tr>";
            //$('#student-table-thead').html(thed);
            $('#students-table-thead-tr').html(thed);
            $('#school-students').html('Loading...');
        },
        success:function(res){
            var row="";
            var options ="";
            if(res.students.data.length>0)
            {
                $.each(res.students.data,function(index,student){
                    row+="<tr>"+
                            "<td><input type='checkbox' name='school_student' value='"+student.id+"' class='form-check'></td>"+
                            "<td><a href='/user/edit/"+student.id+"' class='nav-link'>"+student.firstName+" "+student.lastName+"</a></td>"+
                            "<td>"+student.id+"</td>"+
                            "<td>"+student.email+"</td>"+
                        "</tr>";
                });
                /**
                 * get class subjects 
                 */
                $.each(res.subjects,function(index,subject){
                    options += "<option value='"+subject.id+"'>"+subject.subject_name+"</option>";
                });
            }else{
                row ="<tr><td colspan='4'><b><i>No students enrolled for this class</i></i></b></td></tr>";
            }
                $('#school-students').html(row);
                $('.pagination').html(res.paginate);
                $('.form-student-title').show();
                $('.form-student-title').html("<h6>Category: Students;&nbsp;&nbsp; <span class='right'>Class: "+text+"</span></h6>"); 
                $('#class_subjects').append(options);           
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
           
            $('#submission_id').val(sub_id);
            $('#feedback_submission_id').val(sub_id);
            $('#user-attachments').html(attachment);
            $('.graded').html(grade);
            $('#assigned_grade').val(grade);
        }
    });
 }

 function loadAttachment(id)
 {
     $('#document_link').val(id);  
        // this function is fetched from pdfJavascript page online 438
    LoadDocument(id);
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
                     
                     $('#assigned_comment').val("");
                     $('#feed_back_comment').val("");
                     var comm ="";
                     var feedback ="";
                     $.each(res.comments,function(index,comment){
                        comm+="<div class='comment p-2 my-1'>"+comment.comment+"</div>";
                        var date = new Date(comment.created_at);
                        var time = date.getMonth()+" / "+date.getFullYear()+", "+date.getHours()+":"+date.getMinutes()+" Hrs";
                        feedback+= "<div class='mt-2'>"+
                                        comment.comment+"<br>"+
                                        "<span class='text-muted'>"+
                                            comment.user.firstName+" "+comment.user.lastName+
                                            "<span class='right'>"+
                                                time+
                                            "</span>"+
                                        "</span>"+
                                    "</div>"

                     });
                     console.log(res);
                    $('.submission-comments').html(comm);
                    $('#comments-fetched').html(feedback);
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
  * blur a region or area
  */
 function blurSection(sect)
 {
    $('.'+sect).append("<div class='position-absolute loading-spinner'><img src='{{asset('EDUC-ITECH logo edited.png')}}'></div>");
 }

 /**
  * add students to a subject
  */
 function subjectEnroll(subject,array)
 {
      // check the value of the option selected
            $.ajax({
                url:"/subject/massEnroll",
                data:{
                    subject:subject,
                    list:array
                },
                beforeSend:function(){
                    $('.FloatingDiv').html('Enrolling students');
                },
                success:function(res){
                    window.location.reload(true);
                }
            });
 }

 function checkSection(funct,name)
 {
     if(checkedBoxes(name).length > 0)
     {
        if(funct == 'Subject-enroll-users'){
            $('.class-subjects').show();
            $('.school-classes').hide();
        }else if(funct == 'Promote-to-Class')
        {
            $('.school-classes').show();
            $('.class-subjects').hide();
        }else if(funct == 'un-enroll'){
            $('.class-subjects').show();
            $('.school-classes').hide();            
        }
     }else{
        $('#functions').val('');
     }
     
 }
 
 function studentFunctions(name)
 {
     // check the section selected
     var array = checkedBoxes(name);
     var funct = $('#functions').val();
     if(funct == 'Subject-enroll-users') // call the functon to enroll users
     {
        var subject = $('#class_subjects').val();
        if(!subject) // if no subject is selected
        {
            alert('No subject is selected');
            return;
        }
        // if a subject was selected
        subjectEnroll(subject,array);
     }else if(funct == 'Promote-to-Class')
     {
        var form = $('#school-classes').val();
        if(!form)
        {
            alert('No class was selected');
            return;
        }
        // call the function to promote students
        promoteStudents(form,array);
     }else if(funct == 'un-enroll'){
        // check if user is asking to remove students from a subject
        var subject = $('#class_subjects').val(); 

        // pick user password to confirm
        var pw = prompt('Confirm your password to continue');
        unEnrollStudents(subject,array,pw);

     }else if(funct ==""){
         xdialog.alert('Please seclect a function to use');
         return;
     }
 }

 /**
  * function to promote students
  */
 function promoteStudents(cls,list)
 {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        type :'post',
        url:"/promote/students",
        data:{
            list:list,
            newform:cls
        },
        beforeSend:function(){
            $('.student-page').html("Promoting Sudents...");
        },
        success:function(res){
            xdialog.alert('Students promoted successfully to'+cls);
        }
    });
 }
 /**
  * check all checkboxes function
  */
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

/**
 * all selected
 */
function checkedBoxes(name)
{
    var array = $.map($('input[name="'+name+'"]:checked'), function(c){return c.value; })
    if(array.length == 0)
    {
        alert('Please select items to use');
    }
    return array;
}

/**
 * un enroll stuents from a subject
 */
function unEnrollStudents(subject,list,password)
{
    if(!password)
    {
        email = prompt("Confirm your email to continue:");
    }
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/unenroll/students',
        type:'post',
        data:{
            subject:subject,
            email:email,
            list:list
        },
        success:function(res){
            window.location.reload(true);
        },
        error:function(error){
            xdialog.alert("Error removing user from subject");
        }
    });
}

/**
 * add attachment to timetable upload
 */
function addAttachment(cls)
{
    var div = "<div class='form-group'>"+
                 "<input type='file' name='timetable_attachment[]' id='timetable' class='form-control form-control-sm'>"+
              "</div>";
    $('#'+cls).append(div);
}

//send back graded work to the student
function addGradedAttachment()
{
    var div = "<input type='file' name='graded_work[]'' id='graded_work' class='form-control'>";
              
    $('#graded-attachment-form').append(div);
}
/**
 * show side nav div with button click
 */

 function toggleSideNav(dv) {
    $('.side-nav').addClass("display-div");
  }

$(document).on('click','.hide-bar',function(){
    $('.side-nav').hide();
});

//load subjects for a class from the databas
function loadSubjects(form,sect)
{
    
    $.ajax({
        url:'/subjects/find',
        data:{
            id:form
        },
        success:function(res){
            var opt = "";
            $.each(res.subjects,function(index,subject){
                opt += "<option value='"+subject.id+"'>"+subject.subject_name+"</option>";
            });
            if(opt.length == 0)
            {
               opt =  "<option value=''>No subjects found</option>";
               xdialog.alert('No subjects found for the selected class');
            }
           $('#'+sect).html(opt);
        },  
        error:function(err){
            xdialog.alert('Error locating the class subjects');
        }
    });
}

//create notifications for the school term
const termNotifications =[];
const termDays =[];
function termNotice(id)
{
    $.ajax({
        url:'/term/notice',
        data:{
            id:id
        },
        success:function(res){
            var note ="";
            var date = new Date();
            var enddate = new Date(res.terms.term_end_date);
            var dateDiff = enddate - date;
            var hours = dateDiff / 3600000
            hours = Math.round(hours);
            //alert(hours);

            // check hours 
            if(hours < 24) // less than a day remaining
            {
                //alert('You have less than a day to have the term closed');
                $('.success-alert-message').show();
                termNotifications.push('You have less than a day to have the term closed')
                //$('.message-display').html('You have less than a day to have the term closed');
                var days = hours / 24;
                days = Math.round(days);
                termDays.push(days);
                $('term-days-count').html(days+' Days');
            }else{ // check if it is more than a day
                var days = hours / 24;
                days = Math.round(days);

                $('term-days-count').html(days+' Days');

                if(days <= 14)// fortnight remainig to close the term
                {
                    $('.success-alert-message').show();
                    $('.message-display').html('You have 14 days left to close the term. Finalise with term activities');
                }
            }
        }
    });
}

// show calender function
function showCalender(id)
{
    $.ajax({
        url:'/term/notice',
        data:{
            id:id
        },
        success:function(res){
            var note ="";
            var date = new Date();
            var enddate = new Date(res.terms.term_end_date);
            var dateDiff = enddate - date;
            var hours = dateDiff / 3600000
            hours = Math.round(hours);
            //alert(hours);

            // check hours 
            if(hours < 24) // less than a day remaining
            {
                //alert('You have less than a day to have the term closed');
                //$('.success-alert-message').show();
                termNotifications.push('You have less than a day to have the term closed')
                //$('.message-display').html('You have less than a day to have the term closed');
                var days = hours / 24;
                days = Math.round(days);
                termDays.push(days);
                $('.term-days-count').html(days+' Days');
                $('.term-calendar').show();

            }else{ // check if it is more than a day
                var days = hours / 24;
                days = Math.round(days);
                termDays.push(days);
                $('term-days-count').html(days+' Days');
                //$.each(termDays,function)
                if(days <= 14)// fortnight remainig to close the term
                {
                    termNotifications.push('You have '+days+' days to have the term closed')
                }

                var days = hours / 24;
                days = Math.round(days);
                termDays.push(days);
                $('.term-days-count').html(days+' Days');
                $('.term-calendar').show();
            }
        }
    });
}

/**
 * activate user account by admin
 */

function activateAccount(id)
{
    
    email = prompt("Confirm your email to continue:");
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/account/activation',
        data:{
            id:id,
            email:email
        },
        type:'post',
        dataType:'json',
        success:function(res){
            window.location.reload(true);
        },
        error:function(error){
            xdialog.alert("Error activating account");
        }
    });
}

/**
 * suspend user
 */
 function suspendAccount(id)
 {
    email = prompt("Confirm your email to continue:");
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });

     $.ajax({
         url:'/account/deactivation',
         data:{
             id:id,
             email:email
         },
         type:'post',
         dataType:'json',
         success:function(res){
             window.location.reload(true);
         },
         error:function(error){
             xdialog.alert("Error suspending account");
         }
     });
 }

 /**
  * start conference call back function
  */
 function startConference(id)
 {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:'/conference/start',
        data:{
            id:id
        },
        type:'post',
        success:function(res){
            window.location.reload(true);
        }
    });

 }
/**
 * end conference call back function
 */

 function endConference(id)
 {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:'/conference/end',
        data:{
            id:id
        },
        type:'post',
        success:function(res){
            window.location.reload(true);
        }
    });

 }

 function deleteConference(id)
 {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:'/conference/delete',
        data:{
            id:id
        },
        type:'post',
        success:function(res){
            window.location.reload(true);
        }
    });

 }
 /**
  * check dates for assignments
  */
 function checkDates()
 {
     var start = $('#assignment_start_date').val();
     var end = $('#assignment_deadline').val();
     var close = $('#assignment_close_date').val();
     var startDate = new Date(start);
     var endDate = new Date(end);
     var closeDate = new Date(close);
     
     if(endDate < startDate)
     {
         xdialog.alert('Start Date cannot be after end date');
         $('#assignment_deadline').val('');
     }

     if(endDate >= closeDate)
     {
         xdialog.alert('Close date cannot be before end Date');
         $('#assignment_close_date').val('');
     }
 }

 /**
  * check dates for announcements
  */
  function checkDate(date1,date2)
  {
      
      var startDate = new Date(date1);
      var endDate = new Date(date2);
      
      
      if(endDate < startDate)
      {
          xdialog.alert('Start Date cannot be after end date');
      }
      
      if(endDate <= startDate)
      {
          xdialog.alert('End date cannot be before or equal to start Date');
      }
  }
 /**
  * delete feedback comment
  */
 function deleteComment(id)
 {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/feedback/comment/delete',
        type:'post',
        data:{
            id:id
        },
        success:function(){
            window.location.reload(true);
        }
    });
 }

/**
 * show message details
 */
function messageDetails(id)
{
    $('.message-details').show();
    $.ajax({
        url:'/message/read',
        data:{
            id:id
        },
        beforeSend:function(){
            $('.message-details').html('<h4>loading...</h4>');
        },
        success:function(res){            
                var date = new Date(res.message.created_at);
                var month = date.getMonth();
                var day = date.getDate();
                var year= date.getFullYear();
                var Hour = date.getHours();
                var min = date.getMinutes();
                var complete = day+'-'+month+'-'+year+", "+Hour+":"+min+" Hrs";
                var div ="<div class='p-2'>"+
                        "<div class='header p-2'>"+
                           "<b>From:</b> "+res.message.email+"<br>"+
                           "<b>Date: </b>"+ complete +"<br>"+
                           "<b>Subject:</b> "+res.message.subject+
                        "</div>"+
                        "<div class='p-3 header'>"+
                            res.message.message+"<br>"+
                            res.message.name+
                        "</div>"+
                        "<div class='p-2'>"+
                            "<span class='text-muted'><center>Copyright@educitech ltd 2021</center></span>"+
                        "</div>"+
                      "</div>";
            
            $('.message-details').html(div);
            //console.log(res);
        },
        error:function(error){
            xdialog.alert("error loading message");
        }
    });
}


/**
 * load marksheet for the exam selected
 */
function loadMarksheet(form,formName)
{
    var exam = $('#form-marksheet-exams').val();
    
    if(!exam || !form){
        alert('Please select the exam first');
        return;
    }else{
        // call the function to load the marksheet
        generatemarksheet(exam,form,formName);
    }
}

function generatemarksheet(exam,form,formName)
{
    $.ajax({
        url:'/marksheetView',
        data:{
            form:form,
            exam:exam
        },
        dataType:'json',
        beforeSend:function(){
            $('.marksheet').html('<h3>Loading...</h3>');
        },
        success:function(res){
            console.log(res);
            // get subjects
            var header =  "<table class='table table-sm table-bordered'><thead><tr><th colspan="+colspan(4,res.subjects.length)+"><center>"+formName+" Marksheet ("+$('#exam_name_marksheet').text()+")</center></th></tr><tr><th>#</th><th>Name</th>";
            $.each(res.subjects,function(index,subject){
                header += "<th>"+short(subject)+"</th>";
            });
             header +='<th>Tot</th><th>Avg</th></tr></thead><tbody>';
             // generate table body
             console.log(res.students);
             // check if students are available for a given class
             if(res.students.length > 0)
             {
                $.each(res.students,function(index,student){
                    ++index;
                    const data =[];
                    header +="<tr>"+
                                "<td>"+index+"</td>"+
                                "<td>"+student.firstName+" "+student.lastName+"</td>";
                                $.each(res.subjects,function(index,subj){
                                    header += "<td>"+getMarks(res,subj,student.id)+"</td>";
                                    //push data to array to get averate and total
                                    if(getMarks(res,subj,student.id) > 0)
                                    {
                                        data.push(getMarks(res,subj,student.id));
                                    }
                                });
                    header+="<td><b>"+total(data)+"</b></td><td><b>"+average(data)+"</b></td></tr>";

                });
            }else{
                header+="<tr><td colspan="+colspan(4,res.subjects.length)+"><center><h4><i>No students Found</i></h4></center></td></tr>";
            }
             header+="</tbody></table>";
             header+="<h4 class='header'>Key to subjects</h4>";
             // show the key for every subject indicated in the table
                        $.each(res.subjects,function(index,key){
                            index++;
                            header += "<div class='border-bottom'>"+index +". "+ short(key) +" : "+ key +"</div>";
                        });
             $('.marksheet').html(header);
        },
        error:function(err){
            //alert('Error generating marksheet');
            $('.marksheet').html('<h3><center><i>Error generating marksheet</i></center></h3>');
        }
    });
}


// gradesheet generator
function loadGradesheet(form,formName)
{
    var exam = $('#form-marksheet-exams').val();
    
    if(!exam || !form){
        alert('Please select the exam first');
        return;
    }else{
        // call the function to load the marksheet
        generategradesheet(exam,form,formName);
    }
}

function generategradesheet(exam,form,formName)
{
    $.ajax({
        url:'/marksheetView',
        data:{
            form:form,
            exam:exam
        },
        dataType:'json',
        beforeSend:function(){
            $('.gradesheet').html('<h3>Loading...</h3>');
        },
        success:function(res){
            console.log(res);
            // get subjects
            var header =  "<table class='table table-sm table-bordered'><thead><tr><th colspan="+colspan(4,res.subjects.length)+"><center>"+formName+" Gradesheet ("+$('#exam_name_marksheet').text()+")</center></th></tr><tr><th>#</th><th>Name</th>";
            $.each(res.subjects,function(index,subject){
                header += "<th>"+short(subject)+"</th>";
            });
             header +='<th>Agg</th><th>Div</th></tr></thead><tbody>';
             // generate table body
             console.log(res.students);
             // check if students are available for a given class
             if(res.students.length > 0)
             {
                $.each(res.students,function(index,student){
                    ++index;
                    const data =[];
                    const Agg =[];
                    header +="<tr>"+
                                "<td>"+index+"</td>"+
                                "<td>"+student.firstName+" "+student.lastName+"</td>";
                                $.each(res.subjects,function(index,subj){
                                    header += "<td>"+GradingScale(getMarks(res,subj,student.id))+"</td>";
                                    //push data to array to get averate and total
                                    // push after finding marks
                                    if(getMarks(res,subj,student.id) > 0)
                                    {
                                        data.push(getMarks(res,subj,student.id));
                                        // create an array of results
                                        Agg.push(numberGrades(GradingScale(getMarks(res,subj,student.id))));
                                    }
                                });
                    header+="<td><b>"+total(Agg)+"</b></td><td><b>"+setDivision(Agg)+"</b></td></tr>";

                });
            }else{
                header+="<tr><td colspan="+colspan(4,res.subjects.length)+"><center><h4><i>No students Found</i></h4></center></td></tr>";
            }
             header+="</tbody></table>";
             header+="<h4 class='header'>Key to subjects</h4>";
             // show the key for every subject indicated in the table
                        $.each(res.subjects,function(index,key){
                            index++;
                            header += "<div class='border-bottom'>"+index +". "+ short(key) +" : "+ key +"</div>";
                        });
             $('.gradesheet').html(header);
        },
        error:function(err){
            //alert('Error generating marksheet');
            $('.gradesheet').html('<h3><center><i>Error generating marksheet</i></center></h3>');
        }
    });
}


// function to get marks
function getMarks(res,subj,user)
{
    const final =[];
    var grade = 0;
    $.each(res.results,function(index,mark){
        if(mark.subject.subject_name === subj && mark.user.id === user)
        {          
            grade = mark.marks;
        }else{
            $grade ="";
        }
        final.push(grade);
    });
    return markValue(final);
}
/**
 * shorten a word
 */
function short(me)
{
    var word = me[0]+ me[1] + me[2];
    return word;
}

// return positive value
function markValue(arr)
{
    var gd ="";
    for(i = 0;i < arr.length;i++){
        if(arr[i] > 0)
        {
             gd = arr[i];
             //return gd;
        }
    }
    return gd;
}

// get colspan value
function colspan(no,len)
{
    var span = no + len;
    return span;
}

// get total for the results
function total(arr)
{
    var sum = 0;
     sum = arr.reduce((a, b) => a + b, 0);
    return sum;
}

function average(arr)
{
    var tot = total(arr);
    var nos = arr.length;
    var average = tot / nos;
    return Math.round(average);
}

// grademarks function
function GradingScale(mark)
{
    var gd ="";
    if(mark > 0)
    {
        if(mark > 0 && mark <= 34){
            gd = "F9";
        }else if(mark<=44){
            gd="P8";
        }else if(mark<=54){
            gd="P7";
        }else if(mark<=59){
            gd="C6";
        }else if(mark<=64){
            gd="C5";
        }else if(mark<=69){
            gd="C4";
        }else if(mark<=74){
            gd="C3";
        }else if(mark<=79){
            gd="D2";
        }else if(mark<=100){
            gd="D1";
        }
    }else{
        gd = "X";
    }
    return gd;
}

// get number grade to get aggregates
function numberGrades(gd)
{
    var num = "";
    if(gd == "F9"){
        num = 9;
    }else if(gd=="P8"){
        num= 8;
    }else if(gd== "P7"){
        num=7;
    }else if(gd=="C6"){
        num=6;
    }else if(gd=="C5"){
        num=5;
    }else if(gd=="C4"){
        num=4;
    }else if(gd=="C3"){
        num = 3;
    }else if(gd == "D2"){
        num= 2;
    }else if(gd=="D1"){
        num=1;
    }else{
        num = 0;
    }
    return num;
}

// get division basing on the aggregate array
function setDivision(arr)
{
    var Div = "";
     var Agg = total(arr);
    if(arr.length < 8){
        Div ="Div X";
    }else{
        // check other conditions for the grading scale
        if(Agg <= 32){
            Div = "Div 1";
        }else if(Agg > 32 && Agg <= 44){
            Div = "Div 2"
        }else if(Agg >44 && Agg <= 58){
            Div = "Div 3";
        }else if(Agg >58 && Agg <= 68){
            Div = "Div 4";
        }else{
            Div = "Div 9";
        }

    }
    return Div;
}

// display div if checked
function displayChecked(display)
{
    $('.'+display).style.display ='block';
}