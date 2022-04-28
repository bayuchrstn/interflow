$.scrollUp({
    scrollName: 'page_scroller',
    scrollDistance: 300,
    scrollFrom: 'top',
    scrollSpeed: 500,
    easingType: 'linear',
    animation: 'fade',
    animationSpeed: 200,
    scrollTrigger: false,
    scrollTarget: false,
    scrollText: '<i class="fa fa-chevron-up"></i>',
    scrollTitle: false,
    scrollImg: false,
    activeOverlay: false,
    zIndex: 2147483647
});

function kirim() {
    var data = new FormData($("#form_data")[0]);
    $.ajax({
        url:base_url+"Main/ajax_kirim_lamaran",
        data : data,
        type:"POST",
        dataType:"JSON",
        cache:false,
        async : true,
        contentType: false,
        processData: false,
        beforeSend : function() {
            $("#btn-simpan").attr("disabled", true).html('Mengirim ...');
        },
        complete:function() {
            $("#btn-simpan").attr("disabled", false).html('Kirim');
        },
        success:function(data) {
            if(data.status == true) {
                $("#msg_alert").html(data.message);
                $("#form_data")[0].reset();        
            } else {
                $("#msg_alert").html(data.message);
            }
            window.scroll({top: 330, left: 0, behavior: 'smooth'});
        },
        error:function(error) {
            console.log(error);
        }
    });
}

$('input[type="file"]').bind('change', function() {
    let max_size  = parseFloat(2);
    let filename  = this.files[0].name;
    let file_size = this.files[0].size/1024/1024;
    let file_ext  = filename.split('.').pop();
    var notif = '';
    if(file_size > max_size) {
        notif += "- File anda "+ file_size + " MB, Maksimal upload file 1MB";
    }

    if(notif != '') {
        notif += '<br>';
    }

    if(file_ext != 'PDF' && file_ext != 'pdf') {
        notif += "- Format file anda '"+ file_ext + "', Format harus file 'pdf'";
    }

    if(notif != '') {
        $("#"+this.id).val("");
        bootbox.alert(notif);
    }
});