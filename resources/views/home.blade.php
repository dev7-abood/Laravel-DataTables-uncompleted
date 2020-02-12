<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{'plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'}}">
    <title>Document</title>
</head>
<body>


<div class="container">
    <br/>
    <h3 align="center">Laravel 6 using YajraBox</h3>
    <br/>
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record
        </button>
    </div>
    <br/>

    <table class="table table-striped table-bordered dataTable" id="names-table">
        <thead>
        <tr align="center">
            <th>Id</th>
            <th>first name</th>
            <th>last name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
</div>


<script src="{{'js/app.js'}}"></script>
<script src="{{'plugins/bootstrap/dist/js/bootstrap.min.js'}}"></script>
<script src="{{'plugins/datatables/datatables.net/js/jquery.dataTables.min.js'}}"></script>
<script>
    $(document).ready(function () {
        $('#names-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.names') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false},
            ]
        });


        $('#create_record').click(function () {
            $('#ModalCenter').modal('show')
        });

        $('#name_form').on('submit', function (e) {
            e.preventDefault();
            let action_url = '';
            if ($('#action').val() == 'Add') {
                action_url = "{{route('name.store')}}"
            }
            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $("#success_message").text(data.success).show();
                        setTimeout(function () {
                            $("#success_message").hide();
                            $('#name_form')[0].reset();
                        }, 6000)
                    }
                },
                error: (xhr, status, error) => {
                    let err = eval("(" + xhr.responseText + ")");
                    if (err.errors) {
                        $.each(err.errors, function (key, val) {
                            $(`#${key}_alert`).text(val).show();
                            setTimeout(function () {
                                $(`#${key}_alert`).text(val).hide()
                                $('#name_form')[0].reset();
                            }, 8000)
                        });
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).on('click', '#edit', function () {
        $('#EditModal').modal('show');
        let id = $(this).attr('name');
        $('#hidden_id').val(id)
        $.get("/edit-name/" + id, function (data) {
            $('#edit_first_name').val(data.result.first_name);
            $('#edit_last_name').val(data.result.last_name);
        });

        $("#edit_name_form").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('name.update')}}",
                method: "post",
                data: $(this).serialize(),
                dataType: "json",
                success : function(data) {
                    $('#names-table').DataTable().ajax.reload();
                }
            })
        })


    });
</script>
</body>
</html>


<!-- Modal Add -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result" class="form_result"></span>
                <form id="name_form" method="post">
                    @csrf
                    <div id="success_message" class="alert alert-success mb-2" style="display: none"></div>

                    <label for="first_name" class="font-weight-bold">First name</label>
                    <input id="first_name" name="first_name" class="form-control" type="text"
                           placeholder="Default input">
                    <div id="first_name_alert" class="alert alert-danger mt-2" style="display: none"></div>


                    <label for="last_name" class="mt-2 font-weight-bold">Last name</label>
                    <input id="last_name" name="last_name" class="form-control" type="text" placeholder="Default input">
                    <div id="last_name_alert" class="alert alert-danger mt-2" style="display: none"></div>

                    <input type="hidden" id="action" value="Add">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Save Record</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Add -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result" class="form_result"></span>


                <form id="edit_name_form" method="post">
                    @csrf
                    <div id="success_message" class="alert alert-success mb-2" style="display: none"></div>
                    <label for="edit_first_name" class="font-weight-bold">First name</label>
                    <input id="edit_first_name" name="first_name" class="form-control" type="text"
                           placeholder="Default input">
                    <div id="edit_first_name_alert" class="alert alert-danger mt-2" style="display: none"></div>

                    <label for="edit_last_name" class="mt-2 font-weight-bold">Last name</label>
                    <input id="edit_last_name" name="last_name" class="form-control" type="text"
                           placeholder="Default input">
                    <div id="edit_last_name_alert" class="alert alert-danger mt-2" style="display: none"></div>

                    <input type="hidden" id="edit_action" value="edit">

                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="edit_submit" class="btn btn-primary">Edit Record</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
