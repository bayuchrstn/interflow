$(document).ready(function () {

    $.ajax({

        url: base_url + "Main/ajax_data_consultant",

        type: "GET",

        dataType: "JSON",

        success: function (data) {

            let html = '<div class="row">';

            for (let i = 0; i < data.length; i++) {

                consultant = data[i];
                let agent_email = consultant.email;
                let email_chars = consultant.email.length;
                let email_str;

                if (email_chars < 26) {
                    email_str = agent_email;
                } else {
                    email_str = agent_email.substring(0, 24) + '...';
                }

                html += '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6"><div class="team-1"><div class="team-photo"><a href="' + base_url + 'Main/detail_consultant?q=' + consultant.id + '"><img src="' + consultant.host + consultant.foto + '" alt="agent" class="img-fluid"></a></div><div class="team-details"><h5><a href="' + base_url + 'Main/detail_consultant?q=' + consultant.id + '">' + consultant.nickname + '</a></h5><h6><i class="flaticon-phone"></i> ' + consultant.phone + ' <br><br> <i class="fa fa-envelope"></i> ' + email_str + '</h6></div><a href="' + base_url + 'Main/detail_consultant?q=' + consultant.id + '" class="btn btn-primary btn-block">View Detail</a></div></div>';

            }



            html += '</div>';



            $(".our-team-content").html(html);

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