<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
        <meta name="author" content="Creative Tim">
        <title><?php echo $_SESSION["systemname"]; ?></title>
        <?php require __DIR__ . '/../css.php'; ?>
    </head>

    <body>
    <!-- Main content -->
        <div class="main-content">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary mb-0" style="top:100px">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center" style=" font-weight: bold;">
                                <h1>Hi, User</h1>
                            </div>
                            <hr>
                            <div class="text-center" style=" font-weight: bold;">
                                <h5>There was a request to change your password!</h5>
                                <h5>Below is your temporary username and password</h5>
                            </div>
                            <hr>
                            <div class="text-center" style=" font-weight: bold;">
                                <h3>Username: </h3>
                                <h3>Password: </h3>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo base_url(); ?>index.php/Login/login_screen" class="btn btn-primary my-4">Log In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require __DIR__ . '/../js.php'; ?>
    </body>
</html>