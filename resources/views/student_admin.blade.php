@extends('layout.main')

@section('main-section')
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/ajax_model.css') }}">
        <script src=" {{ asset('js/ajax_modal.js') }} "></script>
        <script src=" {{ asset('js/jquery.js') }} "></script>
    </head>

    <body>
        <div class="container">

            <h2 class="text-success text-center">Admin Table</h2>
            <a href=" {{ route('user.add') }} "> <input name="" id="add_data"
                    class="btn btn-primary float-right m-1" type="button" value="Create"></a>

        <table border="1px" class="table">
                <thead>
                    <tr>
                        <th>Student_</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>age</th>
                        <th>Designation</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->full_name }} </td>
                            <td> {{ $user->phone_number }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->age }} </td>
                            <td>
                                @if ($user->role == 0)
                                    Student
                                @else
                                    Admin
                                @endif
                            </td>
                            <td> <a href=" {{ route('user.edit', ['id' => $user->id]) }} "><button type="button"
                                        id="edit_btn" data-id=" {{ $user->id }} "
                                        class="btn btn-primary">Edit</button>
                                </a></td>
                            <td> <a href=" {{ route('user.delete', ['id' => $user->id]) }} ">
                                 <button type="button"  onclick="return confirm('Are you sure?')"  id="delete_btn" "
                                                            class="btn btn-danger">Delete</button> </a> </td>
                                                </tr>
                                            </tbody>
                    @endforeach    
            </table>
        </div>
    </body>

    </html>
@endsection
