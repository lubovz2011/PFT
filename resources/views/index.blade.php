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
        <a class="navbar-brand" href="#">PFT</a>
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

    @include("modals.signIn")
    @include("modals.signUp")


    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
       //     $('#sign-up-modal').modal();
        });
    </script>
</body>
</html>
