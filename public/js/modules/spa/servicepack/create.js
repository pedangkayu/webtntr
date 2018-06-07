$(function(){
  $('.summernote').summernote({
    height: 600,
    placeholder: 'Description',
    onChange: function(contents, $editable) {
      $(this).val(contents);
    }
  });

  matematika_price = function(){
    var price_public = $('[name="price_publish"]').val();
    var price_contract = $('[name="price_contract"]').val();
    var percen_contract = $('[name="percen_contract"]').val();
    var contract = price_contract.length < 1 ? 0 : price_contract;
    var publish = price_public.length < 1 ? 0 : price_public;

    var price = publish - contract;
    var percen = (price / contract) * 100;

    // $('[name="price_contract"]').val(contruct);
    var percen_fix = parseFloat(percen).toFixed(2)
    $('[name="percen_contract"]').val(percen_fix);

  }
  matematika_percen = function(){
    var price_public = $('[name="price_publish"]').val();
    var price_contract = $('[name="price_contract"]').val();
    var percen_contract = $('[name="percen_contract"]').val();
    var contract = price_contract.length < 1 ? 0 : price_contract;
    var publish = price_public.length < 1 ? 0 : price_public;

    var _out = (contract * percen_contract) / 100;
    var out = parseInt(_out) + parseInt(contract);

    $('[name="price_publish"]').val(out);
    // var percen_fix = parseFloat(percen).toFixed(2)
    // $('[name="percen_contract"]').val(percen_fix);

  }

});
