$(function(){

  var id = $('[name="id"]').val();

  $('#spa-all').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/anyschedule/' + id),
          method: 'POST'
      },
      columns: [
    {data: 0, name: 'nm_schedule'},
    {data: 1, name: 'time_start'},
    {data: 2, name: 'status'},
    {data: 3, name: 'id'}
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

  deleteschedule = function(id){
    var c = confirm('Are you sure ?');
    if(c){
      $.ajax({
          url: base_url('/spa/schedule/' + id),
          type: 'DELETE',
          dataType : 'json',
          success: function(json) {
              toastr.success(json.err);
          }
      });
    }
  }

});
