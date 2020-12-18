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
                            List users registered
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
                    <div class="page-header">
                        <h1>Users Registered <small>overview &amp; stats </small></h1>
                    </div>
                    <!-- end: PAGE TITLE & BREADCRUMB -->
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: DYNAMIC TABLE PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            USERS REGISTERED
                        </div>
                        <div class="panel-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table id="myTable" class="display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>NIK</th>
                                            <th>UNIT</th>
                                            <th>EMAIL</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIVE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">
                                        <?php
                                        $no = 0;
                                        foreach ($user as $row) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row->name; ?></td>
                                                <td><?= $row->nik; ?></td>
                                                <td><?= $row->uo; ?></td>
                                                <td><?= $row->email; ?></td>
                                                <td><?= date("Y-m-d H:i:s", $row->date_created); ?></td>
                                                <td><?php echo $row->is_active == 0 ? "<span class='label label-sm label-danger'>Inactive</span>" : "<span class='label label-sm label-success'>Active</span>"; ?></td>
                                                <td class="center">
                                                    <div>
                                                        <a href="<?= base_url(); ?>admin/approve/<?= $row->id; ?>" class="btn btn-xs btn-teal tooltips approve" data-placement="top" data-original-title="Approve"><i class="fa clip-thumbs-up"></i></a>
                                                        <a href="<?= base_url(); ?>admin/nonactive/<?= $row->id; ?>" class="btn btn-xs btn-teal tooltips nonactive" data-placement="top" data-original-title="Non Active"><i class="fa clip-thumbs-up-2"></i></a>
                                                        <a href="<?= base_url(); ?>admin/delete/<?= $row->id; ?>" class="btn btn-xs btn-bricky tooltips remove-user" data-placement=" top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: DYNAMIC TABLE PANEL -->
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

<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'colvis'
            ]
        });
        $(".download").click(function() {
            if (confirm('Are you sure will download this document ? this action will update release date')) {
                setTimeout(location.reload.bind(location), 500);
                location.href = '<?php echo base_url('user/viewtech'); ?>';
            } else {
                return false;
            }
        });
    });
</script>