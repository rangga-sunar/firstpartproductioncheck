<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container">
            <!-- start: PAGE HEADER -->
            <div class="row">
                <div class="col-sm-12">
                    <!-- start: PAGE TITLE & BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li>
                            <i class="clip-home-3"></i>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li class="active">
                            Dashboard
                        </li>
                        <li class="search-box">
                            <form class="sidebar-search">
                                <div class="form-group">
                                    <input type="text" placeholder="Start Searching...">
                                    <button class="submit">
                                        <i class="clip-search-3"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ol>
                    <div class="page-header">
                        <h1>Dashboard <small>overview &amp; stats </small></h1>
                    </div>
                    <!-- end: PAGE TITLE & BREADCRUMB -->
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="alert alert-success">
                <button data-dismiss="alert" class="close">
                    &times;
                </button>
                <i class="fa fa-check-circle"></i>
                <strong>Wellcome!</strong> You visited first part production check website version Beta
            </div>
            <?php if ($this->session->userdata('nik') == "140762") : ?>
                <div class="col-sm-2">
                    <div class="core-box">
                        <div class="heading">
                            <i class="clip-user-4 circle-icon circle-green"></i>
                            <h2>Manage Users</h2>
                        </div>
                        <div class="content">

                        </div>
                        <a class="view-more" href="#">
                            View More <i class="clip-arrow-right-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="core-box">
                        <div class="heading">
                            <i class="clip-clip circle-icon circle-teal"></i>
                            <h2>Manage Orders</h2>
                        </div>
                        <div class="content">

                        </div>
                        <a class="view-more" href="#">
                            View More <i class="clip-arrow-right-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="core-box">
                        <div class="heading">
                            <i class="clip-database circle-icon circle-bricky"></i>
                            <h2>Manage Data</h2>
                        </div>
                        <div class="content">

                        </div>
                        <a class="view-more" href="#">
                            View More <i class="clip-arrow-right-2"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->