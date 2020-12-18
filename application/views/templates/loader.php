<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo base_url(); ?>assets/images/loading5.gif') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

<div class="loader"> </div>
<script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });
</script>