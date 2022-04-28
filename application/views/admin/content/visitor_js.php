<script src="//www.google.com/jsapi" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/charts-google.min.js" type="text/javascript"></script>
<script>
	$('#tgl_awal').datepicker({
         format: "yyyy-mm-dd"
    });
    $('#tgl_akhir').datepicker({
         format: "yyyy-mm-dd"
    });

    // LINE CHART
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Date');
    data.addColumn('number', 'Unique Visitors');

    data.addRows(<?php echo isset($json)?$json:''; ?>);
    
    var options = {
        chart: {
            title: 'Statistik Pengunjung Web'
        }
    };

    var chart = new google.charts.Line(document.getElementById('gchart_line_1'));
    chart.draw(data, options);
</script>