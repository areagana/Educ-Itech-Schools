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