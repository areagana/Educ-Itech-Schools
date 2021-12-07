
<style>
    .p-2{
        padding:2px;
    }
    .header{
        padding:4px;
        border-bottom:1px solid lightgrey;
    }
</style>
<div class='p-2'>
    <h4 class="header">{{$note->note_title}}</h4>
    <div class="p-2">
        {!!$note->note_content!!}
    </div>
</div>