<head>
    <title> Interflow Property </title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta http-equiv="expires" content="0">
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v5.0"></script>
    <input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>">
<center>

    <?php
        $filename = 'Interflow_Property_Brosur_';
        $brochure_url = base_url('assets/ebrosur/'.$filename.$data->id.'.pdf');
        $link = urlencode($brochure_url); 
    ?>

    <table>
        <tr>
            <td style="padding-right: 10px;">
                <a class="btn btn-md btn-danger" style="padding: .2rem 1rem;" download="<?php echo $filename.$data->id.'.pdf'; ?>" 
                    href="<?php echo $brochure_url; ?>">
                    <i class="icon-file-pdf"></i> 
                    Download PDF 
                </a>
                <!-- <button type="button" id="btn_pdf" class="btn btn-md btn-danger" style="padding: .2rem 1rem;"> </button> -->
            </td>

            <td>
                <b> Share to Social Media : &nbsp; </b>
            </td>

            <td> 
                <div class="fb-share-button" data-href="<?php echo $brochure_url; ?>" data-layout="button" data-size="large">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                    Share</a>
                </div>
            </td>

            <td>
                <a target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?url=<?php echo $link; ?>" data-size="large">
                    Tweet</a>
            </td>

            <td>
                <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $link; ?>" class="btn btn-success" style="padding: .2rem 0.5rem;"> 
                    <i class="fa fa-whatsapp fa-lg"></i>
                    <span style="margin-left: 3px;"> WhatsApp </span> 
                </a>
            </td>
        </tr>
    </table>

    <!-- <embed src="<?php echo $brochure_url; ?>" type="application/pdf" width="100%" height="100%"> -->
    <iframe src="<?php echo 'https://docs.google.com/viewer?url='.$brochure_url.'?&embedded=true'; ?>" width="100%" height="100%"> </iframe>

</center>

</body>

<style>

    .container {
        position: relative;
        color: white;
    }

    .responsive {
        width: 80%;
        height: auto;
    }

    .status-properti {
        font-family: "Arial Black", Gadget, sans-serif;
        font-size: 65px;
        color: white;
        letter-spacing: 2px;
        text-shadow: 4px -4px 3px rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    table.content {
        position: absolute;
        top: 30%;
        left: 15%;
    }

    tr > td.harga {
        text-align: center;
        padding-top: 10px;
        font-family: "Arial Black", Gadget, sans-serif;
        font-size: 22;
    }

    tr > td img.property_img {
        text-align: center;
        max-width: 100%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    tr > td.judul {
        vertical-align: top;
    }

    table.tb-fasilitas {
        font-size: 12px;
    }

    tr > td.fasilitas {
        vertical-align: top;
    }

    /* tr > td.fasilitas > .row {
        margin-left: 0;
        margin-right: 0;
    } */

    table.tb-footer {
        width: -webkit-fill-available;
    }

    tr > td.qr {
        text-align: center;
    }

    tr > td.kontak-agen {
        text-align: right;
        padding: 10px;
        /* max-width: 82px; */
    }

    tr > td.qr > #qrcode > img {
        margin-left: auto;
        margin-right: auto;
    }

    tr > td.qr > .scan {
        font-family: "Arial Black", Gadget, sans-serif;
        color: #ff9201;
    }

</style>



<script src="<?= base_url(); ?>assets_admin/global_assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/qrcode/qrcode.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/loaders/blockui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";

    /* $.ajax({
        url: base_url+"admin/Manage_properti/generate_ebrosur_pdf",
        type: "POST",
        data: {
            id: $('#id').val()
        },
        beforeSend: function () {
            $.blockUI( { message:'<h4> Loading ... </h4>' } );
        },
        complete: function () {
            $.unblockUI();

            // setTimeout(() => {
                $('iframe').show();
            // }, 1000);
        },
        success: function (data) {
            console.log(data);
        },
        error: function () {
            toastr.warning('Terjadi error saat membuat file');
        }
    }); */

    /* html2canvas(document.getElementById("brochure"), {
            onrendered: function(canvas) {
                var file_img = canvas.toDataURL("image/png");

                // Send HTML Canvas DataURL
                $.ajax({
                    url: base_url+"admin/Manage_properti/generate_ebrosur_image",
                    type: "POST",
                    data: {
                        id: $('#id').val(),
                        image: file_img
                    },
                    beforeSend: function () {
                        $.blockUI( { message:'<h4> Loading ... </h4>' } );
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function () {
                        toastr.warning('Terjadi error saat membuat file');
                    }
                });

            }
        }); */

    


    $("#btn_img").click(function(){
	
        html2canvas(document.getElementById("brochure"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/png");
                var name = 'Interflow_Property_Brosur_' + <?php echo $data->id; ?> + '.png';
                // console.dir(canvas);

                var triggerDownload = $("<a>").attr("href", img).attr("download",name).appendTo("body");
                triggerDownload[0].click();
                triggerDownload.remove();
            }
        });

    });

    $("#btn_pdf").click(function(){
	
        /* html2canvas(document.getElementById("brochure"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF("landscape", "mm", [ 900.50, 500.28 ]);
                var width = pdf.internal.pageSize.width;    
                var height = pdf.internal.pageSize.height;
                pdf.addImage(canvas, 'JPEG', 0, 0,width,height);
                pdf.save('Interflow_Property_Brosur_' + <?php echo $data->id;?> + '.pdf');
            }
        }); */

    });

</script>



<script>

    window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
        t._e.push(f);
    };

    return t;
    }(document, "script", "twitter-wjs"));

</script>