@extends('layout.main')

@section('main-section')
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <h2 class="text-success text-center">User Table</h2>

            <table border="1px" class="table">
                <thead>
                    <tr>
                        <th>Student_id</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>age</th>
                        <th>Designation</th>
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
                                @if ( $user->role == 0 )
                                    Student
                                @else
                                    Admin
                                @endif
                               </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </body>
    </html>
@endsection
