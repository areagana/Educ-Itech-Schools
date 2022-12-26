<div class="p-2">
    <table class="table table-sm table-bordered border">
        <thead>
            <tr>
                @foreach($level->gradings() as $scale)
                <th>
                    {{$scale->min_value}} {{$scale->max_value}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($level->gradings() as $scale)
                <td>
                    {{$scale->grade}}
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>