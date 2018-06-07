$(function(){

  $('.summernote').summernote({
    height: 550,
    placeholder: 'Description',
    onChange: function(contents, $editable) {
      $(this).val(contents);
    }
  });

  $('#demo-date-inline-start').datepicker({
    todayHighlight: true,
    format: "yyyy-mm-dd"
  }).on('changeDate', function(e) {
    $('[name="date_start"]').val(
        $(this).datepicker('getFormattedDate')
    );
  });

  $('#demo-date-inline-end').datepicker({
    todayHighlight: true,
    format: "yyyy-mm-dd"
  }).on('changeDate', function(e) {
    $('[name="date_end"]').val(
        $(this).datepicker('getFormattedDate')
    );
  });



});
