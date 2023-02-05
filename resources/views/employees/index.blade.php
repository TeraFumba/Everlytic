@extends('layouts.app')

@section('content')

    <button  class=" btn btn-dark float-right mt-2 mb-2" data-toggle="modal" data-target="#exampleModal">
        Add new user
    </button>

    <br/>
    @if ($employees->count() !== 0)
        <table class="table table-striped">
            <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name.' '.$employee->last_name  }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <a href="#"  >
                            <i class="fa fa-trash-o " onclick="deleteConfirmation({{$employee->id}})" style="font-size:20px;color:red" ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <br/>
    <!-- Modal -->
    <div class="modal fade " id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new user</h5>
                </div>
                <form id="employee"  method="post" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="first_name" class="form-control" id="name"  placeholder="Enter name">
                            <span class="text-danger" id="nameErrorMsg"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Surname</label>
                            <input type="text" name="last_name" class="form-control" id="surname"  placeholder="Enter surname">
                            <span class="text-danger" id="surnameErrorMsg"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <span class="text-danger" id="emailErrorMsg"></span>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position"  placeholder="Enter position">
                            <span class="text-danger" id="positionErrorMsg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="refresh()" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#employee').on('submit', function(e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var name        = $('#name').val();
            var surname     = $('#surname').val();
            var email       = $('#email').val();
            var position    = $('#position').val();
            $.ajax({
                type: "POST",
                url: "{{url('/employee/create')}}/",
                data: {first_name:name, last_name:surname, email:email, position:position,_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function( msg ) {
                    if(msg.hasOwnProperty('error')){
                        msg.message.hasOwnProperty('first_name') ? $('#nameErrorMsg').text(msg.message.first_name) : $('#nameErrorMsg').text('')
                        msg.message.hasOwnProperty('first_name') ? $( "#name" ).addClass( 'is-invalid') : $( "#name" ).removeClass( 'is-invalid')

                        msg.message.hasOwnProperty('last_name') ? $('#surnameErrorMsg').text(msg.message.last_name) : $('#surnameErrorMsg').text('')
                        msg.message.hasOwnProperty('last_name') ? $( "#surname" ).addClass( 'is-invalid') : $( "#surname" ).removeClass( 'is-invalid')

                        msg.message.hasOwnProperty('position') ? $('#positionErrorMsg').text(msg.message.position) : $('#positionErrorMsg').text('')
                        msg.message.hasOwnProperty('position') ? $( "#position" ).addClass( 'is-invalid') : $( "#position" ).removeClass( 'is-invalid')

                        msg.message.hasOwnProperty('email') ? $('#emailErrorMsg').text(msg.message.email) : $('#emailErrorMsg').text('')
                        msg.message.hasOwnProperty('email') ? $( "#email" ).addClass( 'is-invalid') : $( "#email" ).removeClass( 'is-invalid')
                    }
                    else if(msg.hasOwnProperty('success')){
                        swal("Done!", msg.message, "success").then(function(){
                            $('#nameErrorMsg').text('')
                            $( "#name" ).removeClass( 'is-invalid')

                            $('#surnameErrorMsg').text('')
                            $( "#surname" ).removeClass( 'is-invalid')

                            $('#positionErrorMsg').text('')
                            $( "#position" ).removeClass( 'is-invalid')

                            $('#emailErrorMsg').text('')
                            $( "#email" ).removeClass( 'is-invalid')
                        });
                    }
                }
            });
        });
        function deleteConfirmation(id) {
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function (e) {

                if (e === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'DELETE',
                        url: "{{url('/employee/delete')}}/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {

                            if (results.success === true) {
                                swal("Done!", results.message, "success").then(function(){
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
        function refresh()
        {
            location.reload();
        }
    </script>
@endsection

