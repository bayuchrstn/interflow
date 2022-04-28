<script>
 
 $(document).ready(function () {

    <?php 
        $level = $this->session->userdata('level'); 

        if ($level != 3) {
    ?>

        $('#telp option:first').attr('disabled', 'disabled');
        $('#telp').select2();

    <?php } else { 
            $user_id = $this->session->userdata('id');
    ?>
    
        $('#telp').val(<?php echo $user_id; ?>).trigger("change");
        $('#telp').select2("readonly", true);

        // $('#telp').val(<?php echo $user_id; ?>).change();

    <?php } ?>

});

    function add_fasilitas(){
        let numItems_plus = $('.count_class').length;
        return '<input type="hidden" name="id_facility[]"/>' +
                '<div class="form-group row count_class">' +
                    '<label class="col-form-label col-lg-2" style="max-width: 17.5%;"> </label>' +
                    '<div class="col-lg-5">' +
                        '<div class="input-group">' +
                            '<select name="fasilitas_opt[]" class="form-control select2_facility">'+ // '+numItems_plus+'
                                        '<?php echo preg_replace("/[\r\n]*/","",$opt_fasilitas_2); ?>'+
                            '</select>'+
                        '</div>' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                        '<div class="input-group">' +
                        '<input type="text" name="fasilitas_lbl[]" class="form-control" placeholder="Jumlah / Keterangan" autocomplete="off">' + // '+numItems_plus+'
                        '</div>' + 
                    '</div>' +
                '</div>';              

    }

    $('#trig_add_facility').click(function() {
        let facility = add_fasilitas();
        $('#facility_nest').append(facility);
        $(".select2_facility option:first").attr('disabled', 'disabled');
        $(".select2_facility").select2();
    });


    
function clear_form_properti() {
    $('#form-properti').trigger('reset');
    $("#id").val('');
    $('#features').val("").change();
    $('#jns_property').val("0").change();
    $('#status_property').val("0").change();

    <?php if ($level != 3) { ?>
        $('#telp').val("0").change();
    <?php } ?>

    $.ajax({
        url: base_url + "admin/Manage_properti/new_fasilitas_property",
        type: "GET",
        success: function (data) {
            $('#fasilitas_properti').html(data);
            $(".select2_facility option:first").attr('disabled', 'disabled');
            $(".select2_facility").select2();
        }
    });

    $('#Dropzone1').val('');
    $('#Dropzone2').val('');
    $('#Dropzone3').val('');
    $('#Dropzone4').val('');
    $('#Dropzone5').val('');
    $('#koordinat').val('');

    if (typeof marker !== 'undefined') {
        marker.setMap(null);
    }
}

</script>