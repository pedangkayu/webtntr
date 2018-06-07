$(function() {

  var id = $('#id').val();

  $('#services').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/listspa/services/' + id),
          method: 'POST'
      },
      columns: [
        {data: 0, name: 'img_thumbnail'},
        {data: 1, name: 'servicepack'},
        {data: 2, name: 'price_publish'},
        {data: 3, name: 'id_servicepack'}
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
      }
  });

  // packages
  $('#packages').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/listspa/packages/' + id),
          method: 'POST'
      },
      columns: [
        {data: 0, name: 'img_thumbnail'},
        {data: 1, name: 'servicepack'},
        {data: 2, name: 'price_publish'},
        {data: 3, name: 'id_servicepack'}
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
      }
  });

  trush = function(id){
    var c = confirm('Are you sure ?');
    if(c){
      $.ajax({
          url: base_url('/spa/servicepack/' + id),
          type: 'DELETE',
          dataType : 'json',
          success: function(json) {
              toastr.success(json.err);
          }
      });
    }
  }

});
