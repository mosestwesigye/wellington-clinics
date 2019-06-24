
function openPopup(amount, pack){
  // console.log(pack);
  document.getElementById('id_amount').innerHTML = amount
  document.getElementById('id_package').innerHTML = pack
  $('#myModal').modal('show');
  $('input').val('');
}

$("#id_patient_id").on('change', function(){
  var id = $(this).val()
  console.log(id);

  var _dialog = transaction_dialog("Transaction in progress. Please wait.");
  _dialog.open();

  $.ajax({
    url: "get_patient.php",
    type: "GET",
    cache: false,
    data: {"id": id, "request": "checkRegister"},
    success: function(res){
      var data = JSON.parse(res);
      if(data.status == "ok"){
        console.log("okay");
        $("#id_patient_first_name").val(data.first_name)
        $("#id_patient_last_name").val(data.last_name)
        $("#id_patient_number").val(data.phone_number)
        $("#id_patient_email").val(data.eamil)
        $("#patientid_error").html()
        success_dialog("Patient Found", _dialog);
      }else{
        console.log("empty");
        $("#id_patient_first_name").val('')
        $("#id_patient_last_name").val('')
        $("#id_patient_number").val('')
        $("#id_patient_email").val('')
        $("#patientid_error").html("Patient with the ID provided not found")
        success_dialog("Patient with the ID provided not found", _dialog);
      }
      console.log(data.first_name);
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
    }
  });
});

$("#id_phone_number").on('change', function(){
  var check_number = validate_phonenumber($(this).val());
  if (!check_number){
    error_dialog("The number '"+$(this).val()+"' is not valid. The correct number format 2567XXXXXXXX")
  }
})

// request for Mobile Money Payment
$("#submit_request").on('click', function(){

  var mm_number = $("#id_phone_number").val()
  var patient_number = $("#id_patient_number").val()
  var first_name = $("#id_patient_first_name").val()
  var last_name = $("#id_patient_last_name").val()
  var email = $("#id_patient_email").val()
  var patient_id = $("#id_patient_id").val()
  var agent = $("#id_agent_number").val()
  var amount = $("#id_amount").html()

  if(mm_number == ""){
    error_dialog("Please provide the Phone Number");
    return;
  }

  if(first_name == ""){
    error_dialog("Please provide the Patient's First Name");
    return;
  }

  if(last_name == ""){
    error_dialog("Please provide the Patient's Last Name");
    return;
  }

  if(email == ""){
    error_dialog("Please provide the Patient's Email Address");
    return;
  }

  amount = amount.replace(/,/g, "");

  var _dialog = transaction_dialog("Transaction in progress. Please wait.");
  _dialog.open();

  $.ajax({
    url: "mobile_money_payment.php",
    type: "POST",
    cache: false,
    data: {"msisdn": mm_number, "patient_number": patient_number, "first_name": first_name, "last_name": last_name,
    "email": email, "patient_.id": patient_id, "agent": agent, "amount": amount},
    success: function(res){
      var data = JSON.parse(res);
      console.log(res);
      if(data.status == "ok"){
          success_dialog_closeAll('A withdraw request has been sent to the number '+ mm_number+'. Please confirm the transaction by entering your Pin');
      }else{
          error_dialog("Transaction has failed, please try again later.", _dialog)
      }

    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
    }
  });

});

function validate_phonenumber(number){
  var patt = /^2567[5087619][0-9]{7}$/i;
  var mat = number.match(patt);
  if(mat){
    return true;
  }
  return false
}

function transaction_dialog(message){
  var dialog = new BootstrapDialog({
    type: BootstrapDialog.TYPE_DEFAULT,
    closable: false,
    message: message,
  });
  dialog.realize();
  dialog.getModalHeader().hide();
  dialog.getModalFooter().hide();
  return dialog;
}

function error_dialog(message, _dialog){
  var dialog = new BootstrapDialog({
      type: BootstrapDialog.TYPE_DANGER,
      title: 'Error',
      message: message,
      buttons: [{
         label: 'Close',
         cssClass: 'btn-danger',
         action: function(dialog){
             dialog.close();
             _dialog.close();
         }
     }]
  });
  dialog.open();
}

function success_dialog(message, _dialog){
  var dialog = new BootstrapDialog({
    type: BootstrapDialog.TYPE_DEFAULT,
    closable: false,
    message: message,
    buttons: [{
         label: 'Close',
         action: function(dialog){
              dialog.close();
              _dialog.close()
          }
     }]
  });
  dialog.open();
}

function success_dialog_closeAll(message){
  var dialog = new BootstrapDialog({
    type: BootstrapDialog.TYPE_DEFAULT,
    closable: false,
    message: message,
    buttons: [{
             label: 'Close',
             cssClass: 'btn-warning',
             action: function(){
                 // You can also use BootstrapDialog.closeAll() to close all dialogs.
                 $.each(BootstrapDialog.dialogs, function(id, dialog){
                     dialog.close();
                     $('#myModal').modal('hide');
                     window.location.href = "https://wellingtonclinic.cliniko.com/bookings#service";
                 });
             }
         }]
  });
  dialog.open();
}
