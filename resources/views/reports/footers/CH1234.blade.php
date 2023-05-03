<div class="p-2">
    <table class="table table-sm table-bordered border">
        <thead>
            <tr>
                <th colspan='{{$level->gradings()->count()}}'>GRADING SCALE</th>
            </tr>
            <tr class='border'>
                @foreach($level->gradings as $scale)
                <th class='border'>
                    {{$scale->min_value}} - {{$scale->max_value}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr class='border'>
                @foreach($level->gradings as $scale)
                <td class='border'>
                    {{$scale->grade}}
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>