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
                            Program
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
                        <h1>FIRST PART PRODUCTION CHECK <small>overview &amp; stats </small></h1>
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
                            FIRST PART PRODUCTION CHECK
                            <div class="panel-tools">
                                <a class="btn btn-xs btn-link" href="<?= base_url('user/excel'); ?>" title="Export to excel">
                                    <i class="fa clip-file-excel "></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <?php if ($this->session->userdata('uo') == 'PE') : ?>
                                    <button onclick="add_data()" class="btn btn-pinterest">
                                        <i class="fa fa-facebook"></i>
                                        | Entry new data
                                    </button>

                                <?php endif; ?>

                                <table id="table" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:125px;">ACTION</th>
                                            <th>NO</th>
                                            <th>PARTNUMBER</th>
                                            <th>PEF</th>
                                            <th>PROGRAM</th>
                                            <th>TYPE</th>
                                            <th>CREATED BY</th>
                                            <th>DATE CREATED</th>
                                            <th>DRAWING IDX</th>
                                            <th>REVISION</th>
                                            <th>remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: DYNAMIC TABLE PANEL -->
                </div>
            </div>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->


<script type="text/javascript">
    var save_method; //for save method string
    var table;



    $(document).ready(function() {

        hide_file();

        //datatables
        table = $('#table').DataTable({
            "lengthChange": false,

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('N219_controller/ajax_view') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [6, 7, 8, 9, 10], //last column
                "orderable": false, //set not orderable
                "length": false
            }, ],

        });

        //datepicker
        $('.date-picker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });


    });

    function hide_file() {

        $('.berkas').hide();
        $('.filelama').hide();

    }

    function delete_data(id) {

        const flashData = $(".flash-data").data('flash', 'Deleted');

        Swal({
            title: "Are You Sure",
            text: "FPPC Will Be Delete",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete!",
        }).then((result) => {
            if (result.value) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('N219_controller/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');

                        if (flashData) {
                            Swal({
                                title: "Success Message",
                                text: "Success Deleted",
                                type: "success",
                            });
                        }
                        reload_table();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }

    function add_data() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add FPPC'); // Set Title to Bootstrap modal title
    }

    function edit_file(id) {
        $('#form_upload')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('N219_controller/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="partnumber"]').val(data.partnumber);
                $('[name="program"]').val(data.program);
                $('#modal_form_upload').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Upload File FPPC'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function edit_data(id) {
        save_method = 'update';
        $(".berkas").show();
        $(".filelama").show();

        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('N219_controller/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="program"]').val(data.program);
                $('[name="partnumber"]').val(data.partnumber);
                $('[name="type"]').val(data.type).prop('selected', true);
                $('[name="pef"]').val(data.pef);
                $('[name="datecreated"]').val(data.datecreate);
                $('[name="rev"]').val(data.revision);
                $('[name="remark"]').val(data.remark);
                $('[name="drawidx"]').val(data.drawing_idx);
                $('[name="filefppc"]').val(data.file_name);
                $('.filelama').text(data.file_name);
                $('[name="filebefore"]').val(data.file_name);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit FPPC'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('N219_controller/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('N219_controller/ajax_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (!data.status) //if success close modal and reload ajax table
                {
                    alert('There are required field blank, please check your data');
                } else {
                    Swal({
                        title: "Success Message",
                        text: "Success Saving",
                        type: "success",
                    });
                    $('#modal_form').modal('hide');
                    reload_table();
                }

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
</script>
<!-- FORM MODAL ADD DATA -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_form" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" width: 750px; enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="errorHandler alert alert-danger no-display">
                                <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                            </div>
                            <div class="successHandler alert alert-success no-display">
                                <i class="fa fa-ok"></i> Your form validation is successful!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    PROGRAM <span class="symbol required"></span>
                                </label>
                                <input type="text" placeholder="Drawing number" readonly value="<?= substr(strtoupper($this->uri->segment(1)), 0, 4); ?>" class="form-control" id="program" name="program">
                                <input type="hidden" placeholder="Drawing number" readonly value="" class="form-control" id="id" name="id">

                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    TYPE <span class="symbol required"></span>
                                </label>
                                <select name="type" id="type" class="form-control">
                                    <option value=""></option>
                                    <option value="BASIC">BASIC</option>
                                    <option value="COMMON PARTS">COMMON PARTS</option>
                                    <option value="AIRCRAFT">AIRCRAFT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    PARTNUMBER <span class="symbol required"></span>
                                </label>
                                <input type="text" placeholder="Part Number" value="<?= set_value('partnumber'); ?>" class="form-control" id="partnumber" name="partnumber">

                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    PEF <span class="symbol required"></span>
                                </label>
                                <input type="text" placeholder="Pef" value="<?= set_value('pef'); ?>" class="form-control" id="pef" name="pef">
                            </div>

                            <div class="form-group berkas">
                                <label class="control-label">
                                    UPDATE NEW FILE ? <span class="symbol required"></span>
                                </label><br>
                                <label class="control-label filelama" style="font-style: italic;"></label>
                                <input type="hidden" placeholder="Pef" class="form-control" id="filebefore" name="filebefore">
                                <select name="question" id="question" class="form-control">
                                    <option value="NO"></option>
                                    <option value=YES>YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            DATE CREATED <span class="symbol required"></span>
                                        </label>
                                        <input class="form-control date-picker" placeholder="Date Created" type="text" name="datecreated" id="datecreated">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            CREATED BY <span class="symbol required"></span>
                                        </label>
                                        <input type="text" readonly placeholder="Created By" value="<?= $this->session->userdata('nik'); ?>" class="form-control" id="createdby" name="createdby">

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            REVISION
                                        </label>
                                        <div>
                                            <input class="form-control tooltips" placeholder="Revision ex : A,B,C" name="rev" id="rev" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            DRAWING INDEX
                                        </label>
                                        <input class="form-control tooltips" placeholder="Drawing Index" name="drawidx" id="drawidx" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">
                                            REMARK
                                        </label>
                                        <textarea name="remark" id="remark" class="form-control" cols="20" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <span class="symbol required"></span>Required Fields
                                <hr>
                                <!-- <div class="alert alert-danger" role="alert"></div> -->
                            </div>
                        </div>
                    </div>
                    <class="row">

                        <div class=" modal-footer">
                            <button type="button" id="btnupload" onclick="save()" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>

            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END MODAL ADD DATA -->

<!-- START UPLOAD DATA -->
<div class="modal fade" id="modal_form_upload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="<?php echo base_url(); ?>N219_controller/upload_file" id="form_upload" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Partnumber</label>
                            <div class="col-md-9">
                                <input name="partnumber" readonly placeholder="First Name" class="form-control" type="text">
                                <input name="id" id="id" placeholder="First Name" class="form-control" type="hidden">
                                <input name="program" id="program" placeholder="First Name" class="form-control" type="hidden">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">
                            File FPPC
                        </label>
                        <div class="col-xs-9">
                            <input type="file" name="filename" id="filename" class="form-control" />
                        </div>
                    </div>
            </div>
            <div class=" modal-footer">
                <button type="submit" id="btnupload" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- END UPLOAD DATA -->