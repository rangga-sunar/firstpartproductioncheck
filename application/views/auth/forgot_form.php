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
<!-- start: BODY -->

<body class="login example1">
    <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="logo">
            <font color="white"><img src="<?php echo base_url(); ?>assets/images/fppc white.png" width="250" length="180"> </font>
        </div>

        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <!-- start: REGISTER BOX -->
            <div class="box">
                <h3>Reset Password</h3>
                <p>
                    Type your information in this form :
                </p>
                <form class="form-register" action="<?= base_url('auth/updatepassword'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="hidden" class="form-control" name="id" id="id" value=<?php echo $id; ?> placeholder="New Password">
                            <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            <i class="fa clip-key"></i> </span>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Retype Password">
                            <?= form_error('retype_password', '<small class="text-danger">', '</small>'); ?>
                            <i class="fa fa-key"></i> </span>
                    </div>

                    <div class="form-actions">
                        <a href="<?php echo base_url() ?>auth/index" class="btn btn-light-grey go-back">
                            <i class="fa fa-circle-arrow-left"></i>Back
                        </a></a>
                        <button type="submit" name="submit" class="btn btn-bricky pull-right">
                            Submit <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                    </fieldset>
                </form>
            </div>
            <!-- end: REGISTER BOX -->
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
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="<?= base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/login.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/rainyday/rainyday.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>

    <script language="javascript" type="text/javascript">
        function pulsar(obj) {
            obj.value = obj.value.toUpperCase();
        }
    </script>
</body>