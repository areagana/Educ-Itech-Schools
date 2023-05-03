
<table class="table border-less">
    <thead>
        <tr class='border-big'>
            <th class='text-center' width="150px">
                <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path($logo)))}}" alt="" width='200px' height='180px'>
            </th>
            <th colspan='3'>
                <h1 class='text-center'>{{$school->school_name}}</h1>
                <p class="p-2 text-center mt-1">{{$school->address}}</p>
                <p class="text-center p-2">{{$school->main_contact}}</p>
                <p class="p-2 text-center">{{$school->email}}</p>
            </th>
            <th class='text-center' width="150px">
                <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('placeholder-profile.jpg')))}}" alt="" width='120px' height='125px'>   
            </th>
        </tr>
    </thead>
</table>
<div class="p-2 header-border"></div>