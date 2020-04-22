<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Laravel</title>
    <style>
        .social-login.fa {
            padding: 14px;
            font-size: 1.5rem;
            width: 50px;
            height: 50px;
            text-align: center;
            text-decoration: none;
        }

        .social-login.fa-facebook:hover{
            border: 1px solid #3B5998;
            background: white;
            color: #3B5998;
        }
        .social-login.fa-facebook {
            border: 1px solid #3B5998;
            background: #3B5998;
            color: white;
        }

        .social-login.fa-google:hover{
            border: 1px solid #dd4b39;
            background: white;
            color: #dd4b39;
        }
        .social-login.fa-google {
            border: 1px solid #dd4b39;
            background: #dd4b39;
            color: white;
        }

        .social-login.fa{
            transition: color .5s, background-color .5s;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <form class="form-inline ml-auto">
                <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="button" data-toggle="modal" data-target="#sign-in-modal">Sign in</button>
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#sign-up-modal">Sign up</button>
            </form>
        </div>
    </nav>

    <div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col text-right">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        <p class="text-center m-3">or</p>
                        <div class="row">
                            <a href="#" class="col text-right">
                                <i class="social-login fa fa-google rounded-circle" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="col text-left">
                                <i class="social-login fa fa-facebook rounded-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <p>Don't have an account? <a href="#">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sign-up-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sign up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // $('#sign-in-modal').modal();
        });
    </script>
</body>
</html>
