
function decodenumeral() {
    $("#price").val(
        numeral().unformat($("#price").val())
    );
    $("#valueloan").html(
        numeral().unformat($("#valueloan").html())
    );
    $("#valuedp").html(
        numeral().unformat($("#valuedp").html())
    );
    $("#totloan").html(
        numeral().unformat($("#totloan").html())
    );
    $("#paymonth").html(
        numeral().unformat($("#paymonth").html())
    );
}
function encodenumeral() {
    $("#price").val(
        numeral($("#price").val()).format('0,0')
    );
    $("#valueloan").html(
        numeral($("#valueloan").html()).format('0,0')
    );
    $("#valuedp").html(
        numeral($("#valuedp").html()).format('0,0')
    );
    $("#totloan").html(
        numeral($("#totloan").html()).format('0,0')
    );
    $("#paymonth").html(
        numeral($("#paymonth").html()).format('0,0')
    );
}
function docalculation() {
    decodenumeral();
    $("#valuedp").html($("#price").val() * ($("#dp").val() / 100));
    $("#valueloan").html($("#price").val() - $("#valuedp").html());
    $("#loantimemonth").html($("#loantimeyear").val() * 12);
    $("#totloan").html(
        parseInt($("#valueloan").html()) + (
            $("#valueloan").html() * ($("#intrate").val() / 10000) * $("#loantimeyear").val()
        )
    );
    $("#paymonth").html(Math.ceil(
        ($("#valueloan").html() * (
            $("#intrate").val() / 1200
        )) / (
            1 - (1 / Math.pow(
                1 + ($("#intrate").val() / 1200), $("#loantimemonth").html()
            ))
        )
    ));
    encodenumeral();
}
document.addEventListener("DOMContentLoaded", function () {
    $("#resetbutton").on('click', function () {
        var harga = $(".judul-harga").text();
        var harga2 = harga.replace(/[.Rp*+?^${}()|[\]\\]/g, '');
        harga2 = parseInt(harga2);
        $("#price").val(harga2);
        $("#dp").val('30');
        $("#loantimeyear").val('10');
        $("#intrate").val('10');
        docalculation();
    });
    $("#price").on('keyup', function () {
        docalculation();
    });
    $("#dp").on('keyup', function () {
        docalculation();
    });
    $("#intrate").on('keyup', function () {
        docalculation();
    });
    $("#loantimeyear").on('keyup', function () {
        docalculation();
    });
});

function open_calc() {
    var harga = $(".judul-harga").text();
    var harga2 = harga.replace(/[.Rp*+?^${}()|[\]\\]/g, '');
    harga2 = parseInt(harga2);
    $("#price").val(harga2);
    $("#dp").val('30');
    $("#loantimeyear").val('10');
    $("#intrate").val('10');
    docalculation();
    $("#modalcalculator").modal('show');
}