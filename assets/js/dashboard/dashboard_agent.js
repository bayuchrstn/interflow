
var ajax_properti_aktif = base_url + 'admin/Dashboard/stats_properti_agent';
var ajax_approval = base_url + 'admin/Dashboard/stats_not_approval';

$(document).ready(function () {
    counter_dashboard();  
});

setInterval( () => { 
    counter_dashboard();
}, 10000);



function counter_dashboard() {

    $.when( $.getJSON(ajax_properti_aktif),
            $.getJSON(ajax_approval) )
    .then(function (dt_prpty_active, dt_approval) {

        let jml_prpty_active = dt_prpty_active[0].jumlah;
        let jml_approval = dt_approval[0].jumlah;

        $('#jml_properti_aktif').html(jml_prpty_active);
        $('#jml_approval').html(jml_approval);

        animate_value("#jml_properti_aktif", 0, jml_prpty_active, 1000);
        animate_value("#jml_approval", 0, jml_approval, 1000);
        
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

