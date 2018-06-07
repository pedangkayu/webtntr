$(function(){

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	base_url = function(param){
			return $('meta[name="host"]').attr('content') + param;
	}

	logout = function(){
		$('#logout').submit();
	}

	toastr.options.escapeHtml = true;
	toastr.options.closeButton = true;
	toastr.options.closeHtml = '<button><i class="fa fa-times"></i></button>';
	toastr.options.closeEasing = 'swing';


	$('form > [type="submit"]').attr('data-loading-text', 'Process...');

	$('form').submit(function(){
		$('[type="submit"]').button('loading');
		$('body').css('cursor', 'wait');
	});


	$.getJSON(base_url('/ajax/badges'), function(json){
		if(json.count > 0){
			$('.style-danger').removeClass('hide').html(json.count);
		}else{
			$('.style-danger').addClass('hide').html(json.count);
		}

		var items = `<li class="dropdown-header">Today's messages</li>`;
		for(var i = 0; i < json.count; i++){
			var img = json.items[i].img == '' ? '' : `<img class="pull-left img-circle dropdown-avatar" src="` + json.items[i].img + `"/>`;
			items += `
				<li>
					<a class="alert alert-callout alert-info" href="` + json.items[i].url + `">
						<small class="pull-right text-muted"><small>` + json.items[i].date + `</small></small>
						` + img + `
						<strong>` + json.items[i].title + `</strong><br/>
						<small>` + json.items[i].desc + `</small>
					</a>
				</li>
			`;
		}

		$('.badges-items').html(items);
		if(json.share_badge > 0){
			$('.share-badge > a > .title').append(`<span class="badge" style="background:red;">` + json.share_badge + `</span>`);
		}

	});



	// $('.badges-items').slimScroll({
  //     height: '300px'
  // });

});
