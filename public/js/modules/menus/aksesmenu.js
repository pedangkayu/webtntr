$(function(){
	loadMenu = function(id_level){
		toastr.warning('Mengambil...');
		$('.menu-content').css('opacity', .3);
		$.post(base_url('/ajax/loadtreepage/menus'), {id : id_level}, function(json){
			toastr.clear();
			$('.menu-content').css('opacity', 1);
			$('.header-page').html(json.header);
			$('.menu-content').html(json.content);
			$('[name="level_id"]').val(json.level_id);
			$('.btn-simpan').removeClass('hide');
			$('#tree').checktree();
		}, 'json');
	}
});
