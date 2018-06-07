$(function(){

	// Update Avatar
	var $image = $('.img-container > img');
	// Import image
    var $inputImage = $('#inputImage'),
        URL = window.URL || window.webkitURL,
        blobURL;

    if (URL) {

      $inputImage.change(function () {
        var files = this.files,file;

        if (files && files.length) {
          file = files[0];

        	if (/^image\/\w+$/.test(file.type)) {
           		blobURL = URL.createObjectURL(file);
            	$image.one('built.cropper', function () {
              		URL.revokeObjectURL(blobURL); // Revoke when load complete
            	}).cropper('reset').cropper('replace', blobURL);
          	} else {
            	showMessage('Please choose an image file.');
          	}

          	$('#cropavatar').modal('show');
        }

      });

    } else {
      $inputImage.parent().remove();
    }


    $image.cropper({
    	aspectRatio: 1,
    	//preview: '.img-preview',
    	//rotatable : true,
    	minCropBoxWidth : 20,
        minCropBoxHeight : 20,
    	crop: function (data) {
    		$('#x').val(Math.round(data.x));
    		$('#y').val(Math.round(data.y));
    		$('#height').val(Math.round(data.height));
    		$('#width').val(Math.round(data.width));
    		// $("#rotate").val(Math.round(data.rotate));
    	}
    });

    $('[name="listavatar"]').change(function(){

      var val = $(this).val();
      $.post(base_url('/users/updatefromlist'), { val : val }, function(json){
        toastr.clear();
        toastr.success(json.err);

      }, 'json');

    });

    $('.btn-saveavatar').click(function(){
      $('#saveavatar').submit();
    });

});
