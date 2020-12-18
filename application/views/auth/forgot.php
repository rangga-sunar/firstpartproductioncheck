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
            <h3>Forget Password?</h3>
            <p>
                Enter your e-mail address below to reset your password.
            </p>
            <?= $this->session->flashdata('message'); ?>
            <form class="form-login" action="<?php echo base_url('auth/email_forgot'); ?>" method="post">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <i class="fa fa-envelope"></i> </span>
                    </div>
                    <div class="form-actions">
                        <a href="<?php echo base_url('auth/index'); ?>" class="btn btn-light-grey go-back">
                            <i class="fa fa-circle-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-bricky pull-right">
                            Submit <i class="fa fa-arrow-circle-right"></i>
                        </button>
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