$("#btn-send").click(function () {
    $.ajax({
        url: base_url + "Main/ajax_send_contact",
        type: "POST",
        data: $("#form_data").serialize(),
        dataType: "JSON",
        beforeSend: function () {
            $("#btn-send").html('Sending...').attr('disabled', true);
        },
        complete: function () {
            $("#btn-send").html('Send Message').attr('disabled', false);
        },
        success: function (r) {
            if (r.status == true) {
                $("#alert_notif").html(r.message);
                $('#form_data').trigger("reset");
            } else {
                $("#alert_notif").html(r.message);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});

// Page scroller initialization.
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