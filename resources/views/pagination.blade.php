@extends('index')

@section('table')

    <br />
    <div class="container">
        <h3 align="center">Laravel Pagination using Ajax</h3><br />
        <div id="table_data">
            @include('pagination_data')
        </div>
    </div>

@endsection

@section('table_script')
    <script>
        $(document).ready(function(){

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page)
            {
                $.ajax({
                    url:"/pagination/fetch_data?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>

@endsection
