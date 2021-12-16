@Extends('layouts.app')
@section('crumbs')

@endsection
@include('includes.functions')
@section('content')
     <div class="container-fluid">
         <div class="p-2">
              <h4 class="header p-3 ">Website Messages
               <span class="right inline-block p-2">
                  <a href="" class="nav-link btn btn-circle btn-light btn-sm" @popper(Reply)><i class="fa fa-reply"></i></a>
                  <a href="" class="nav-link btn btn-circle btn-light btn-sm" @popper(Trash)><i class="fa fa-trash"></i></a>
                  <a href="" class="nav-link btn btn-circle btn-light btn-sm" @popper(Share)><i class="fa fa-share"></i></a>
               </span>
              </h4>
              <div class="row p-1">
                <div class="col-md-1">
                  <input type="checkbox" class="form-check-input p-2 mx-2" id='checkAll' onclick="">
                </div>
                <div class="col p-2">
                  <h5>Messages
                  </h5>
                </div>
                <div class="col p-2">
                  <input type="text" class="form-control" id="searchMessage" onkeyup="SearchItemClass('searchMessage','Allmessages','message')" placeholder='Search...'>
                </div>
              </div>
             <div class="row p-2 website-messages mt-2">
               <div class="col" id='Allmessages'>
                 @foreach($messages as $message)
                  <div class="p-2 border-bottom row message">
                    <div class="col-md-1 border-right p-2">
                      <input type="checkbox" class="form-check-input p-2 mx-2"  id="message{{$message->id}}" name='message' value="{{$message->id}}" onclick="">
                    </div>
                    <div class='col p-2' onclick="messageDetails({{$message->id}})"'>
                      {{$message->subject}} <span class="text-muted">({{$message->name}})</span>
                        <span class="ml-4 right text-muted">
                          {{dateFormat($message->created_at,'D jS M y')}},
                          {{dateFormat($message->created_at,'H:i')}} Hrs
                        </span>
                    </div>
                  </div>
                 @endforeach
               </div>
               <!--show message details-->
               <div class="col-md-7 p-3 message-details hidden">
                  
               </div>
              <!--end displaying message details-->
             </div>
         </div>
     </div>
@endsection