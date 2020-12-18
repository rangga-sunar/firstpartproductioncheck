<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<head>
    <?php $this->load->view("templates/auth_header.php") ?>
</head>
<!-- end: HEAD -->
<!-- start: BODY --><br>

<body class="login example1">
    <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="logo">
            <font color="white"><img src="<?php echo base_url(); ?>assets/images/fppc white.png" width="250" length="180"> </font>
        </div>
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <h3>Login Page</h3>
            <p>Type your email and password !</p>
            <?= $this->session->flashdata('message'); ?>
            <form class="form-login" action="<?php echo base_url('auth/index'); ?>" method="post">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i>
                </div>
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Email">
                            <i class="fa fa-envelope"></i> </span>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                            <a class="forgot" href="<?php echo base_url('auth/forgot'); ?>">
                                I forgot my password
                            </a> </span>
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-bricky pull-right">
                            Login <i class="fa fa-arrow-circle-right"></i> </button>
                    </div>
                    <div class="new-account">
                        Don't have an account yet ?
                        <a href="<?php echo base_url(); ?>auth/registration" class="register">
                            Create new account
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- end: LOGIN BOX -->

        <!-- start: COPYRIGHT -->

        <div class="copyright">
            <font color="white"><?php echo date('Y'); ?> &copy; Coded with <img src="<?php echo base_url(); ?>assets/images/love.png" width="15" height="15">By Manufacturing Digital Transformation </font><br>
        </div>
        <!-- end: COPYRIGHT -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <?php $this->load->view("templates/auth_js.php") ?>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script>
        // jQuery(document).ready(function() {
        //     //Main.init();
        //     //Login.init();
        // });
    </script>

</body>