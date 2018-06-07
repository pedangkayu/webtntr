$(function(){
  sendInvoice = function(id){
    var c = confirm('you sure you want to send invoices now ?');
    if(c){
      toastr.info('Sending...');
      $.post(base_url('/mail/sendinvoicemail'), {id : id}, function(json){
        toastr.success(json.err);
      }, 'json');
    }
  }


  sendVoucher = function(id){
    var c = confirm('you sure you want to send voucher now ?');
    if(c){
      $('#myModal').modal('hide');
      var note = $('[name="voucher_note"]').val();
      toastr.info('Sending...');
      $.post(base_url('/mail/sendvoucheremail'), {id : id, note : note}, function(json){
        toastr.success(json.err);
      }, 'json');
    }
  }

})
