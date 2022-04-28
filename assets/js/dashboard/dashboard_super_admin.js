
var ajax_properti_aktif = base_url + 'admin/Dashboard/stats_properti_aktif';
var ajax_properti_on_progress = base_url + 'admin/Dashboard/stats_properti_on_progress';
var ajax_agent = base_url + 'admin/Dashboard/stats_agent';
var ajax_approval = base_url + 'admin/Dashboard/stats_approval';
var ajax_premium_investor = base_url + 'admin/Dashboard/stats_premium_investor';
var ajax_cabang = base_url + 'admin/Dashboard/stats_cabang';
var ajax_properti_new = base_url + 'admin/Dashboard/stats_properti_new';
var ajax_properti_due_date = base_url + 'admin/Dashboard/stats_properti_due_date';
var ajax_jatuhtempo = base_url + 'admin/Dashboard/stats_jatuhtempo';
var ajax_visitor = base_url + 'admin/Dashboard/stats_visitor';

$(document).ready(function () {
    counter_dashboard();  
});

setInterval( () => { 
    counter_dashboard();
}, 10000);



function counter_dashboard() {

    $.when( $.getJSON(ajax_properti_aktif),
            $.getJSON(ajax_properti_on_progress),
            $.getJSON(ajax_agent),
            $.getJSON(ajax_approval),
            $.getJSON(ajax_premium_investor),
            $.getJSON(ajax_cabang), 
            $.getJSON(ajax_properti_new), 
            $.getJSON(ajax_properti_due_date),
            $.getJSON(ajax_jatuhtempo),
            $.getJSON(ajax_visitor) )
    .then(function (dt_prpty_active, dt_prpty_process, dt_agent, dt_approval, dt_prm_invst, dt_cabang, dt_prpty_new, dt_prpty_due_date, dt_jatuhtempo, dt_visitor) {

        let jml_prpty_active = dt_prpty_active[0].jumlah;
        let jml_prpty_process = dt_prpty_process[0].jumlah;
        let jml_agent = dt_agent[0].jumlah;
        let jml_approval = dt_approval[0].jumlah;
        let jml_prm_invst = dt_prm_invst[0].jumlah;
        let jml_cabang = dt_cabang[0].jumlah;
        let jml_prpty_new = dt_prpty_new[0].jumlah;
        let jml_prpty_due_date = dt_prpty_due_date[0].jumlah;
        let jml_jatuhtempo = dt_jatuhtempo[0].jumlah;
        let jml_visitor = dt_visitor[0].jumlah;

        $('#jml_properti_aktif').html(jml_prpty_active);
        $('#jml_properti_process').html(jml_prpty_process);
        $('#jml_agent').html(jml_agent);
        $('#jml_approval').html(jml_approval);
        $('#jml_premium_investor').html(jml_prm_invst);
        $('#jml_cabang').html(jml_cabang);
        $('#jml_properti_new').html(jml_properti_new);
        $('#jml_properti_due_date').html(jml_properti_due_date);
        $('#jml_jatuhtempo').html(jml_jatuhtempo);
        $('#jml_visitor').html(jml_visitor);

        animate_value("#jml_properti_aktif", 0, jml_prpty_active, 1000);
        animate_value("#jml_properti_process", 0, jml_prpty_process, 1000);
        animate_value("#jml_agent", 0, jml_agent, 1000);
        animate_value("#jml_approval", 0, jml_approval, 1000);
        animate_value("#jml_premium_investor", 0, jml_prm_invst, 1000);
        animate_value("#jml_cabang", 0, jml_cabang, 1000);
        animate_value("#jml_properti_new", 0, jml_prpty_new, 1000);
        animate_value("#jml_properti_due_date", 0, jml_prpty_due_date, 1000);
        animate_value("#jml_jatuhtempo", 0, jml_jatuhtempo, 1000);
        animate_value("#jml_visitor", 0, jml_visitor, 1000);
        
    }).fail(function (error) { 
        console.log(error);
    });    

}



function animate_value(id, start, end, duration) {
    // assumes integer values for start and end
    
    var obj = $(id);
    // var obj = document.getElementById(id);
    var range = end - start;
    // no timer shorter than 50ms (not really visible any way)
    var minTimer = 50;
    // calc step time to show all interediate values
    var stepTime = Math.abs(Math.floor(duration / range));
    
    // never go below minTimer
    stepTime = Math.max(stepTime, minTimer);
    
    // get current time and calculate desired end time
    var startTime = new Date().getTime();
    var endTime = startTime + duration;
    var timer;
  
    function run() {
        var now = new Date().getTime();
        var remaining = Math.max((endTime - now) / duration, 0);
        var value = Math.round(end - (remaining * range));
        
        obj.html(value); 
        // obj.innerHTML = value; 
        if (value == end) {
            clearInterval(timer);
        }
    }
    
    timer = setInterval(run, stepTime);
    run();
}

