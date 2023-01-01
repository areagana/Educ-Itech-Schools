@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row mx-1 border border-primary">
            <div class="col p-2">
                <h3 class="p-2 border-bottom">{{$user->firstName}} {{$user->lastName}} - Subject enrollments
                    <span class="right">
                        <button class="btn btn-sm btn-outline-info" onclick="$('#teacher_enroll').toggle('slow')"><i class="fa fa-plus-circle"></i> Enroll</button>
                    </span>
                </h3>
                <div class="p-2 row">
                    <div class="col p">
                        <table class="table table-sm" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Form</th>
                                    <th>Stream</th>
                                    <th>Paper</th>
                                    <th>Date Enrolled</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->dashcards as $card)
                                    <tr>
                                        <td>{{$card->subject->subject_name}}</td>
                                        <td>{{$card->form->form_name}}</td>
                                        <td>{{($card->stream) ? $card->stream->name : ''}}</td>
                                        <td>{{($card->paper) ? $card->paper->name : ''}}</td>
                                        <td>{{$card->created_at}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-circle btn-light right" onclick="$('#card_id{{$card->id}}').show('slow')"><i class="fa fa-ellipsis-v"></i></button>
                                            <div class="more bg-white" id="card_id{{$card->id}}">
                                                <a href="{{route('cardEdit',$card->id)}}" class="nav-link"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{route('cardDelete',$card->id)}}" class="nav-link"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 p-2 border-left border-primary hidden" id='teacher_enroll'>
                        <h4 class="p-2 border-bottom border-primary">Add Class Cards</h4>
                        <div class="p-2">
                            <form action="{{route('addCard',$user->id)}}" method='POST'>
                                @csrf
                                <div class="form-group">
                                    <label for="level_id">LEVEL</label>
                                    <select name="level_id" id="level_id" class="form-control" onchange="loadLevelData($(this).val())">
                                        <option value="">Select</option>
                                        @foreach($school->levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="teacher_id" value="{{$user->id}}">
                                    <input type="hidden" name="term_id" value="{{$term->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" id="class_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($school->subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stream_id">Stream</label>
                                    <select name="stream_id" id="stream_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($school->subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control" onchange="loadSubjectPapers($(this).val())">
                                        <option value="">Select</option>
                                        @foreach($school->subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group hidden subject-papers" id='subject-papers'>

                                </div>
                                <div class="form-group">
                                    <button type='submit' class="btn btn-block btn-flat btn-success">Enroll</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function loadLevelData(id)
        {
            
            if(id !='')
            {
                $.ajax({
                    url:'/level/data',
                    data:{
                        level_id:id
                    },
                    beforeSend:function(){
                        // $('#teacher_enroll').html('<center><div class="super_loader p-4">Loading...</div></center>');
                    },
                    success:function(res){
                        $('.super_loader').hide();
                        var subject ='<option value="">Select</option>';
                        var stream ='<option value="">Select</option>';
                        var form = '<option value="">Select</option>';

                        // subjects
                        $.each(res.subjects,function(index,data)
                        {
                            subject +="<option value='"+data.id+"'>"+data.subject_name+"</option>";
                        });
                        $('#subject_id').html(subject);
                        // stream
                        $.each(res.streams,function(index,str)
                        {
                            stream +="<option value='"+str.id+"'>"+str.name+"</option>";
                        });
                        $('#stream_id').html(stream);
                        //forms
                        $.each(res.forms,function(index,frm)
                        {
                            form +="<option value='"+frm.id+"'>"+frm.form_name+"</option>";
                        });
                        $('#class_id').html(form);

                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            }
        }

        function loadSubjectPapers(id)
        {
            $.ajax({
                url:'/subject/papers',
                data:{
                    id:id
                },
                success:function(res){
                    var pap = "<label>Paper</label><select name='paper_id' class='form-control' required>";
                        pap+="<option value=''>Select</option>";
                    if(res.papers.length > 1){
                            $('.subject-papers').show();
                            $.each(res.papers,function(index,paper){
                                pap +="<option value='"+paper.id+"'>"+paper.name+"</option>";
                            });
                        pap +='</select>';
                        $('#subject-papers').html(pap);
                    }else{
                        $('.subject-papers').hide();
                    }
                },
                error:function(err){
                    console.log(err);
                }
            });
        }
    </script>
@endsection