$(function() {
  $('#spa-all').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/listspa/anydata'),
          method: 'POST'
      },
      columns: [
        {data: 0, name: 'img_thumbnail'},
        {data: 1, name: 'spa'},
        {data: 2, name: 'phone'},
        {data: 3, name: 'email'},
        {data: 4, name: 'premium'},
        {data: 5, name: 'nm_regional'},
        {data: 10, name: 'updated_at'}
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
        $(":input[name='premium']").bootstrapSwitch({
          size : 'mini',
          onText : 'Yes',
          offText : 'No',
          offColor : 'danger'
        });

        $('input[name="premium"]').on('switchChange.bootstrapSwitch', function(e, data) {
          var id = $(this).val();
          $(this).bootstrapSwitch('state', !data, true);
            var c = confirm('Are you sure ?');
            if(c){
              var params = {
                id : id,
                state : data
              };
              toastr.clear();
              $.post(base_url('/spaservice/premium'), params, function(json){
                toastr.success(json.err);
              }, 'json');
              $(this).bootstrapSwitch('toggleState', true, true);

            }
        });

      }
  });

});
