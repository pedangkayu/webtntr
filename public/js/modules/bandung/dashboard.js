$(function(){

  var tahun_income = $('[name="tahun_income"]').val();
  getIncome = function(tahun_income){
    var params = {
      tahun : tahun_income
    };
    var opt = {};
    $.post(base_url('/bandung/statisticincome'), params, function(json){
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

      $('.table-income').html(table);
      $('.tahun').html(tahun_income);
    }, 'json');
  }

  $.post(base_url('/dashboard/anydata'), {}, function(json){

    // TOP SPA
    var tops = '';
    for(var i = 0; i < json.data.tops.length; i++){
      tops += `
        <li class="tile">
          <a class="tile-content ink-reaction" href="` + json.data.tops[i].url + `" target="_blank">
            <div class="tile-icon">
              <img src="` + json.data.tops[i].img + `" />
            </div>
            <div class="tile-text">` + json.data.tops[i].spa + `</div>
          </a>
          <a class="btn btn-flat ink-reaction" href="` + json.data.tops[i].url_view + `" title="Booking total">
            ` + json.data.tops[i].total + `
          </a>
        </li>
      `;
    }
    $('.tops-list').html(tops);

    // Profit Share
    var htm = '';
    for(var i = 0; i < json.share_profit.length; i++){
      htm += `
        <tr>
          <td>` + json.share_profit[i].iso + `</td>
          <td class="text-right">` + json.share_profit[i].total + `</td>
        <tr>
      `;
    }
    $('.list-share-profit').html(htm);
  }, 'json');

  getIncome(tahun_income);

});
