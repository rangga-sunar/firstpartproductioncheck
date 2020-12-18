<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pdfviewer/styles.css" />
    <link rel=" shortcut icon" href="<?php echo base_url(); ?>assets/images/ts.png" />
</head>
<style type="text/css" media="print">
    * {
        display: none;
    }
</style>

<body>
    <div id="app">
        <div role="toolbar" id="toolbar">
            <div id="pager">
                <button data-pager="prev">prev</button>
                <button data-pager="next">next</button>
            </div>
            <div id="page-mode">
                <label>Page Mode <input type="number" value="1" min="1" /></label>
            </div>

        </div>
        <div id="viewport-container">
            <div role="main" id="viewport"></div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/pdfviewer/pdfjs-dist/build/pdf.min.js"></script>
    <script src="<?= base_url(); ?>assets/pdfviewer/src/index.js"></script>
    <script>
        initPDFViewer("<?php echo base_url(); ?>uploads/<?php echo $pdf['file_name']; ?>");
    </script>
</body>

</html>

<script>
    var message = "Right click disable by Administrator, if you want get this file, please contact admin";

    function clickIE4() {
        if (event.button == 2) {
            alert(message);
            return false;
        }
    }

    function clickNS4(e) {
        if (document.layers || document.getElementById && !document.all) {
            if (e.which == 2 || e.which == 3) {
                alert(message);
                return false;
            }
        }
    }

    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS4;
    } else if (document.all && !document.getElementById) {
        document.onmousedown = clickIE4;
    }

    document.oncontextmenu = new Function("alert(message);return false")
</script>