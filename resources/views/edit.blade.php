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
    <div class="container mr-5">
        <h3 class="text-info text-center">Edit Form</h3>
        <div class="text-danger text-center">
            <h4> {{ $error ?? '' }} </h4>
        </div>
        {{-- @php
            var_dump($user);die;
        @endphp --}}
        <form action=" {{ route('user.update', ['id' => $user->id ?? $id]) }} " method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" name="fname" value='{{$user->full_name}}' class="form-control w-50" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Full Name" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text" name="phone_number" value='{{$user->phone_number}}' class="form-control w-50" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Phone Number" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your Phone Number with anyone
                    else.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control w-50" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Age</label>
                <input type="numeric" name="age" value="{{$user->age}}" class="form-control w-50" id="exampleInputPassword1" placeholder="Enter age between 3 to 30" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password"  class="form-control w-50" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" name="password_confirmation"  class="form-control w-50" id="exampleInputPassword1" placeholder="Confirm Password" required>
            </div>

                <div class="form-group">
                  <label for="">User Type</label>
                  <select class="form-control w-50" name="role" id="">
                    <option value="0">Normal User</option>
                    <option value="1">Admin</option>
                  </select>
                </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
