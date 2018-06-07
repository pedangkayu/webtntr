$(function(){
  $('[name="id_spa"]').select2();

  findservice = function(){
    var id_spa = $('[name="id_spa"]').val();
    $.getJSON(base_url('/getservicepack/' + id_spa), function(json){
      $('[name="id_servicepack"]').html(json.option);
      $('[name="id_servicepack"]').select2();
    });
  }

  getdetail = function(){
    var id_servicepack = $('[name="id_servicepack"]').val();
    $.getJSON(base_url('/getdetailservicepack/' + id_servicepack), function(json){
      $('.component').html(json.item);
    });

  }

});
