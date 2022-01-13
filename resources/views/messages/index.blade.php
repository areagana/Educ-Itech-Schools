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
                  <a href="#newsms" data-toggle='modal' class="nav-link btn btn-circle btn-light btn-sm" @popper(SMS)><i class="fa fa-comment"></i></a>
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

          <!-- insert modal for creating messages-->
                                          <div class="modal fade" id="newsms" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title text-dark h3" id="staticBackdropLabel">Send SMS Message</div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="p-2">
                                                            <form action="{{route('smsMessages')}}" method='POST' id='newsmsMessage'>
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="Contacts" class="form-label">Contacts(<i>Enter with country code, Separate contacts with a coma</i>):</label>
                                                                    <input type="text" class="form-control" name='contacts' id='Contacts' placeholder='To..'>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message" class="form-label">Message:</label>
                                                                    <textarea name="message" id="message" cols="30" rows="3" class='form-control'></textarea>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button  class="btn btn-primary btn-sm" type='submit' form="newsmsMessage">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 


          <!--end sms form modal-->

             <div class="row p-2  mt-2">
               <div class="col website-messages" id='Allmessages'>
                 @foreach($messages as $message)
                  @if($message->status != 'read')
                  <div class="p-2 border-bottom row message">
                    <div class="col-md-1 border-right p-2">
                      <input type="checkbox" class="form-check-input p-2 mx-2"  id="message{{$message->id}}" name='message' value="{{$message->id}}" onclick="">
                    </div>
                    <div class='col p-2' onclick="messageDetails({{$message->id}})">
                      <b>
                      {{$message->subject}} <span class="text-muted">({{$message->name}})</span>
                        <span class="ml-4 right text-muted">
                          {{dateFormat($message->created_at,'D jS M y')}},
                          {{dateFormat($message->created_at,'H:i')}} Hrs
                        </span>
                      </b>
                    </div>
                  </div>
                  @else
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
                  @endif
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