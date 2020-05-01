<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/select2-bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Laravel</title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
    <a class="navbar-brand" href="#">PFT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="#">Overview</a>
            <a class="nav-item nav-link" href="#">Transactions</a>
            <a class="nav-item nav-link" href="#">Reports</a>
            <a class="nav-item nav-link" href="#">Accounts</a>
            <a class="nav-item nav-link" href="#">Categories</a>
            <div class="dropdown">
                <span class="fa-stack fa-lg border border-success rounded-circle text-success content-box" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-user-circle-o fa-stack-2x fa-inverse"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Log out</a>
                </div>
            </div>
        </div>
    </div>
</nav>

@yield("content")

<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/select2.full.min.js"></script>

</body>
</html>


