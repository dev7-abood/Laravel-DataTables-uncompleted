@extends('index')
@section('content')
<br>
    <h3 align="center">Full Text Search in Laravel 6 using Ajax</h3>
    <div class="row">
        <div class="col-md-10">
            <input class="form-control" type="text" name="full_text_search" id="full_text_search" placeholder="Search" value="">
        </div>

        <div class="col-md-2">
            @csrf
            <button type="button" name="search" id="search" class="btn btn-success">Search</button>
        </div>
    </div>
    <br>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            load_data('');

            function load_data(full_text_search_query = '')
            {
                let _token = $("input[name=_token]").val();
                $.ajax({
                    url : "{{route('full-text-search.action')}}",
                    method : "POST",
                    data:{full_text_search_query:full_text_search_query, _token:_token},
                    dataType : "json",
                    success : data => {
                        let output = '';
                        // var data = data.data;
                        if(data.length > 0)
                        {
                            for(let count = 0 ; count < data.length ; count ++)
                            {
                                output += "<tr>";
                                output += '<td>' + data[count].id + '</td>';
                                output += '<td>' + data[count].first_name + '</td>';
                                output += '<td>' + data[count].last_name + '</td>';
                                output += '<td>' + data[count].created_at + '</td>';
                                output += '<td>' + data[count].updated_at + '</td>';
                                output += "</tr>";
                            }
                        }else
                        {
                            output += '<tr>';
                            output += '<td colspan="6">No Data Found</td>';
                            output += '</tr>'
                        }
                        $('tbody').html(output)
                    }
                })
            }
            $('#search').click(function () {
                let full_text_search_query = $('#full_text_search').val();
                load_data(full_text_search_query);
            })
        })
    </script>
@endsection
