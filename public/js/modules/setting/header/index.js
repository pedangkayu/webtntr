$(function(){

  $('#spa-all').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/headeranydata'),
          method: 'POST'
      },
      columns: [
    {data: 0, name: 'created_at'},
    {data: 1, name: 'title'},
    {data: 2, name: 'active'},
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
      },
      fnDrawCallback : function(){

        $(":input[name='status']").bootstrapSwitch({
          size : 'mini',
          onText : 'Yes',
          offText : 'No',
          offColor : 'danger'
        });

        $('input[name="status"]').on('switchChange.bootstrapSwitch', function(e, data) {
          var id = $(this).val();
          $(this).bootstrapSwitch('state', !data, true);
            var c = confirm('Are you sure ?');
            if(c){
              var params = {
                id : id,
                state : data
              };
              toastr.clear();
              $.post(base_url('/headerstatus'), params, function(json){
                toastr.success(json.err);
              }, 'json');
              $(this).bootstrapSwitch('toggleState', true, true);

            }
        });

      }
  });

});
