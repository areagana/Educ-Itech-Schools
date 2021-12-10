@component('mail::message')
# Account Creation

    You are most welcome to educ-itec schools
    Your account has been created and is ready. <br>
    Please <a href="www.eductitech.com/login" class="nav-link"><b>login</b></a> to start learning. <br>

Thank you,<br>
{{ config('app.name') }} <br>
<img src="{{asset('EDUC-ITECH logo edited.png')}}" alt="" width='60px' height='60px'>
@endcomponent
