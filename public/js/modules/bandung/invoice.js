$(function() {
  $('#booking-all').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: base_url('/bandung/invoiceanydata'),
          method: 'POST',
          data : {
            status : $('[name="status"]').val()
          }
      },
      columns: [
        {data: 0},
        {data: 1},
        {data: 2},
        {data: 3},
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

});
