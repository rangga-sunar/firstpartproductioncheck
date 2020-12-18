<!-- start: FOOTER -->
<div class="footer clearfix">
    <div class="footer-inner">
        <?php echo date('Y'); ?> &copy; Manufacturing Digital Transformation
    </div>

</div>
<!-- end: FOOTER -->

<!-- start: MAIN JAVASCRIPTS -->
<script src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/blockUI/jquery.blockUI.js"></script>
<script src="<?= base_url(); ?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
<script src="<?= base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
<script src="<?= base_url(); ?>assets/plugins/less/less-1.5.0.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="<?= base_url(); ?>assets/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/datatables/DataTables-1.10.21/js/dataTables.responsive.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/autosize/jquery.autosize.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/js/form-elements.js"></script>
<script src="<?= base_url(); ?>assets/js/ui-buttons.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/myscript.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.idle.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        //TableData.init();
        FormElements.init();
        //Index.init();
        //ui.button.init();
    });
</script>
</body>
<!-- end: BODY -->

</html>

<!-- Start of LiveChat (www.livechatinc.com) code -->
<!-- <script>
    window.__lc = window.__lc || {};
    window.__lc.license = 12251922;;
    (function(n, t, c) {
        function i(n) {
            return e._h ? e._h.apply(null, n) : e._q.push(n)
        }
        var e = {
            _q: [],
            _h: null,
            _v: "2.0",
            on: function() {
                i(["on", c.call(arguments)])
            },
            once: function() {
                i(["once", c.call(arguments)])
            },
            off: function() {
                i(["off", c.call(arguments)])
            },
            get: function() {
                if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
                return i(["get", c.call(arguments)])
            },
            call: function() {
                i(["call", c.call(arguments)])
            },
            init: function() {
                var n = t.createElement("script");
                n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
            }
        };
        !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
    }(window, document, [].slice))
</script>
<noscript><a href="https://www.livechatinc.com/chat-with/12251922/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript> -->
<!-- End of LiveChat code -->