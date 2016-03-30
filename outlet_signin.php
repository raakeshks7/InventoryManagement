<html>
    <head> <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    </head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">DATA CRUNCHERS</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<div class="jumbotron">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
          <h2 class="form-signin-heading">Please sign in</h2>
            <div class="account-wall">
                <form action="dashboard.php" class="form-signin">
                    <input name="username" type="text" class="form-control" placeholder="Owner_Username" required autofocus><br>
                    <input name="password" type="password" class="form-control" placeholder="Owner_Password" required><br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button><br>

               </form>
            </div>
            <form class="form-signin" action="index.html">
                <button type="cancel" class="btn btn-warning btn-block">Cancel</button>
            </form>
        </div>
    </div>
</div>
</html>