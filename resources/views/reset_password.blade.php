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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src=" {{ asset('js/reset_password.js') }} "></script>
    <link rel="stylesheet" href="css/reset_password.css">
    <!------ Include the above in your HEAD tag ---------->

    <div class="container mt-5" style="margin-left:35%">
        <div class="row">
            <div class="col-sm-4">
                <form action=" {{ route('admin.reset.info') }} " method="post">
                    @csrf
                    <label>Enter Your Email</label>
                    <div class="form-group ">
                        <input type="email" name="email" value="" class="form-control"
                            placeholder="Enter Your Current Email">
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input type="password" name="password" value="" class="form-control"
                            placeholder="New Password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input type="password" name="password_confirmation" value="" class="form-control"
                            placeholder="Confirm Password">
                    </div>
                    <input name="restSubmit" id="" class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
