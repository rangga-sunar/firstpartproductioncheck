<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<head>
    <title>First Part Production Check</title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="refresh" content="900">
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fonts/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main-responsive.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/skins/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/theme_light.css" type="text/css" id="skin_color">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/print.css" type="text/css" media="print" />
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/DataTables-1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/DataTables-1.10.21/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/DataTables-1.10.21/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/select2.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datepicker/css/datepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/summernote/build/summernote.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel=" shortcut icon" href="<?php echo base_url(); ?>assets/images/LOGO1.png" />
</head>
<!-- end: HEAD -->
<!-- start: BODY -->

<body class="page-full-width fixed">
    <!-- start: HEADER -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <!-- start: TOP NAVIGATION CONTAINER -->
        <div class="container">
            <div class="navbar-header">
                <!-- start: RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <!-- end: RESPONSIVE MENU TOGGLER -->
                <!-- start: LOGO -->
                <a class="navbar-brand" href="<?= base_url('user/index'); ?>">
                    FIRST PART PRODUCTION CHECK
                </a>
                <!-- end: LOGO -->
            </div>
            <div class="navbar-tools">
                <?php $this->load->view("templates/loader.php") ?>