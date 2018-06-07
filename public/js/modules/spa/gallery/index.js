$(function(){

  var id = $('[name="id"]').val();

  $('#spa-gallery').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/anygallerys/' + id),
          method: 'POST'
      },
      columns: [
        {data: 0},
        {data: 1},
        {data: 2},
        {data: 3}
      ],
      initComplete: function () {
          this.api().columns().every(function () {
              var column = this;
              var input = document.createElement("input");
              $(input).appendTo($(column.footer()).empty())
              .on('change', function () {
                  column.search($(this).val()).draw();
              });
          });
      },
      fnDrawCallback : function(){
        $(".fancybox").fancybox({
          prevEffect		: 'none',
          nextEffect		: 'none',
          closeBtn		: false,
          helpers		: {
            title	: { type : 'inside' },
            buttons	: {}
          }
        });
      }
  });



  trush = function(id){
    var c = confirm('Are you sure ?');
    if(c){
      $.ajax({
          url: base_url('/spa/gallery/' + id),
          type: 'DELETE',
          dataType : 'json',
          success: function(json) {
              toastr.success(json.err);
          }
      });
    }
  }

  update = function(val, id){
    var c = confirm('Are you sure ?');
    if(c){
      $.ajax({
          url: base_url('/spa/gallery/' + id),
          data : {
            title : val
          },
          type: 'PUT',
          dataType : 'json',
          success: function(json) {
              toastr.success(json.err);
          }
      });
    }
  }

});
