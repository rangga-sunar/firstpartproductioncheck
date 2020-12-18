<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <!-- start: PAGE -->
    <div class="main-content">

        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container load_content">
            <!-- start: PAGE HEADER -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                    <?php if ($this->session->flashdata('flash')) : ?>
                        <?php $this->session->flashdata('flash'); ?>
                    <?php endif; ?>
                    <!-- start: PAGE TITLE & BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li>
                            <i class="clip-home-3"></i>
                            <a href="<?= base_url('auth'); ?>">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            View Technicalsheet
                        </li>
                        <li class="active">
                            <?php echo strtoupper($this->uri->segment(4)); ?>
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
                    <br>
                    <!-- end: PAGE TITLE & BREADCRUMB -->
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-default" heigth='100%'>
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            VIEW TECHNICAL SHEET
                        </div>
                        <div class="panel-body">
                            <iframe src="<?= base_url(); ?>uploads/<?= $file_n['file_name']; ?>" width="100%" height="610px"></iframe>
                        </div>
                    </div> <!-- end: DYNAMIC TABLE PANEL -->
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">

            </div>
            <div class="row">

            </div>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->