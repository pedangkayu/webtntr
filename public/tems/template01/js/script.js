$(function(){

  number_format = function(number, decimals, dec_point, thousands_sep) {
	  	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	  	var n = !isFinite(+number) ? 0 : +number,
	    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	    s = '',
	    toFixedFix = function(n, prec) {
	      var k = Math.pow(10, prec);
	      return '' + (Math.round(n * k) / k)
	        .toFixed(prec);
	    };
		  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
		  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		    .split('.');
		  if (s[0].length > 3) {
		    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		  }
		  if ((s[1] || '')
		    .length < prec) {
		    s[1] = s[1] || '';
		    s[1] += new Array(prec - s[1].length + 1)
		      .join('0');
		  }
		  return s.join(dec);
	}

  matematika = function(){
    var person = $('[name="qty_person"]').val();
    var subtotal = $('[name="subtotal"]').val();
    var discount = $('[name="discount"]').val();

    var total_person = person * subtotal;
    var aftdisc = ( (total_person * discount) / 100 );
    var grandtotal = total_person - aftdisc;

    var free_pickup = person > 1 ? 'YES' : 'NO';

    // View Section
    $('.persons').html(number_format(person,0,'.',','));
    $('.total-person').html(number_format(total_person,2,'.',','));
    $('.total').html(number_format(grandtotal,2,'.',','));
    $('.aftdisc').html(number_format(aftdisc,2,'.',','));
    $('.free_pickup').html(free_pickup);
  }

  matematika();

});
