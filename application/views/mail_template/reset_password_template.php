<div style=" font-weight: bold;">
    <h1>Hi, User</h1>
</div>
<hr>
<div style=" font-weight: bold;">
    <h5>There was a request to change your password!</h5>
    <h5>Below is your temporary username and password</h5>
</div>
<hr>
<div style=" font-weight: bold;">
    <h3>Username: <?php echo $username ?></h3>
    <h3>Password: <?php echo $password ?></h3>
</div>
<br>
<div>
    <a href="<?php echo base_url(); ?>index.php/Login/login_screen" class="btn btn-primary my-4">Log In</a>
</div>