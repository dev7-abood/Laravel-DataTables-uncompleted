
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->last_name }}</td>
                <td>{{ $row->created_at }}</td>
                <td>{{ $row->updated_at }}</td>
            </tr>
        @endforeach
    </table>

    {!! $data->links() !!}

</div>
