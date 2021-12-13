@Extends('layouts.app')
@section('crumbs')

@endsection
@include('includes.functions')
@section('content')
     <div class="container-fluid">
         <div class="p-2">
             <div class="header p-2 h4">Website Messages</div>
             <div class="p-2">
                 @foreach($messages as $message)
                  <div class="p-2 border-bottom row mx-2">
                      <div class="p-2 col">
                          <div class="form-check">
                             <input type="checkbox" class="form-check-input"  id="message{{$message->id}}" name='message' value="{{$message->id}}">
                            <label class="form-check-label" for="message{{$message->id}}">
                              {{$message->message}}
                            </label>
                          </div>
                      </div>
                      <div class="p-2 col-md-2 text-muted">
                        {{dateFormat($message->created_at,'D jS M y')}},
                        {{dateFormat($message->created_at,'H:i')}} Hrs
                      </div>
                      
                  </div>
                 @endforeach
             </div>
         </div>
     </div>
@endsection