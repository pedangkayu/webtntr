$(function(){
  var tahun = $('[name="tahun"]').val();
  getChart = function(tahun){
    var id = $('[name="spa_id"]').val();
    var params = {
      id : id,
      tahun : tahun
    };
    var opt = {};
    $.post(base_url('/spastatisticbooking'), params, function(json){
        opt = {
          type: 'line',
          data: {
              labels: json.bulan,
              datasets: [{
                  label: 'All Servicepack',
                  data: json.all.total,
                  fill: false,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255,99,132,1)',
                  borderWidth: 1
              },
              {
                  label: 'Service',
                  data: json.service.total,
                  fill: false,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              },
              {
                  label: 'Package',
                  data: json.package.total,
                  fill: false,
                  backgroundColor: 'rgba(255, 159, 64, 0.2)',
                  borderColor: 'rgba(255, 159, 64, 1)',
                  borderWidth: 1
              }
            ]
          },
          options: {}
        };
        var ctx = $("#booked");
        var Booked = new Chart(ctx, opt);
    });
  }
  getChart(tahun);


  var tahun_income = $('[name="tahun_income"]').val();
  getIncome = function(tahun_income){
    var id = $('[name="spa_id"]').val();
    var params = {
      id : id,
      tahun : tahun_income
    };
    var opt = {};
    $.post(base_url('/spastatisticincome'), params, function(json){
      opt = {
        type: 'line',
        data: {
            labels: json.bulan,
            datasets: json.data
        },
        options: {}
      };
      var ctx = $("#income");
      var Booked = new Chart(ctx, opt);

      // Header table
      var table = `<tr>
        <th>ISO</th>`;
      for(var i = 0; i < json.bulan.length; i++){
        table += `<th class="text-right">` + json.bulan[i].toUpperCase() + `</th>`;
      }
      table += `</tr>`;

      // Content table
      for(var i = 0; i < json.td.length; i++){
        table += '<tr>';
        // currencies
        table += `<td>` + json.td[i].currencies + `</td>`;
        // grand total
        for(var x = 1; x <= json.bulan.length; x++){
          table += `<td class="text-right">` + json.td[i].totals[x] + `</td>`;
        }

        table += '</tr>';
      }

      console.log(json);

      $('.table-income').html(table);
    });
  }
  getIncome(tahun_income);

});
