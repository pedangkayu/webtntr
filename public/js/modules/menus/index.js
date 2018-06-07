$(function(){

	$('.nestable-list').nestable({
		maxDepth : 3
	});

	$('.dd').on('change', function() {

		var data = $('.dd').nestable('serialize');

		toastr.warning('Menyimpan...');
		$.post(base_url('/menu-position'), { data : data }, function(json){
			toastr.clear();
			toastr.success(json.err)
		}, 'json');

	});

	$('.menu-body').hover(function(){
		var id = $(this).data('index');
		$('.action-' + id).toggle();
	});

	delete_menu = function(id){

		var c = confirm("Anda yakin ingin menghapusnya?");

		if(c){
			toastr.warning('Menghapus...');
			$.ajax({
			    url: base_url('/menu/') + id,
			    type: 'DELETE',
			    cache : false,
			    dataType : 'json',
			    success: function(json) {
			    	toastr.clear();
			        toastr.success(json.err);
			        $('[data-menuid="' + json.id + '"]').remove();
			    }
			});

		}



	}

});
