
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
            console.log(res);
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
                    xdialog.alert(res.success);
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
            xdialog.alert(res.success);
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
                    termNotifications.push('You have 14 days to have the term closed')
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
            xdialog.alert(res.success);
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
             xdialog.alert(res.success);
         },
         error:function(error){
             xdialog.alert("Error suspending account");
         }
     });
 }


