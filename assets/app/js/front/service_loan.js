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

$(".btn-showmodal").click(function () {
	var id=$(this).attr('data-id');
	$.ajax({
	type : "POST",
	url  : base_url+"Main/imgloan",
	dataType : "JSON",
	data : {id:id},
	  success: function(data){
		  $.each(data,function(id,deskripsi){
			  $('#myModal').modal('show');
			  // $('[name="deskripsi"]').val(data.deskripsi);
			  $('.modal-body').html(data.deskripsi);
			  $('.modal-title').html(data.judul);
			  // $('#id').val(data.id);
		  });
	  }
	});
});