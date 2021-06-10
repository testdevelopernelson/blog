

$(document).ready(function (){
     if (window.history.replaceState) { // verificamos disponibilidad
          window.history.replaceState(null, null, window.location.href);
     }     

     var colorBtn = '#f98929';

     $('.form-load').submit(function (event){
          $('.loader').fadeIn();
     });


      $('.max-lenght').keyup(function(event) {
          let length = $(this).val().length;
          let max = $(this).data('max');
          if (length > (max-50)) {
               $('.message-maxlength').fadeIn()        
               $('#length').text(length);
          }else{
               $('.message-maxlength').fadeOut()
          }
          if (length > max) {
               $('#length').addClass('error-max-length');
          }else{
               $('#length').removeClass('error-max-length');
          }
     });


    
     $('.validate-characteres').keypress(function(event){
          let charCode = event.charCode;
          let array = [13,16,32,33,40,41,44,46,49,58,63,64,161,168,186,191,192,209,239,241];
          if((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || ($.inArray(charCode, array ) != -1)){
               return true;
          }else{
               return false;
          }
     });

     $(".validate-characteres").on('paste', function(e){
          e.preventDefault();
          return false;
     })

     $('.only-number').mask("#", {reverse: true});
     $('.max-number-11').mask("00000000000", {reverse: true});
      $('#mobile').mask('Z000000000', {
        translation: {
          'Z': {
            pattern: /[3]/
          }
        }
      });

     $('#btnSendDistributor').click(function(event) {
          if(validateInput($('#name')) & validateInput($('#lastname')) &  validateInput($('#country')) &  validateInput($('#phone')) & validateInput($('#email'))  & validateEmail($('#email')) & validateRadio($('#check_policy'))){  
            $('#formDistributor').submit();
          }
     });

      $('#btnSendQuote').click(function(event) {
          if(validateInput($('#name')) & validateInput($('#lastname')) &  validateInput($('#phone'))  & validateInput($('#email'))  & validateEmail($('#email')) &  validateInput($('#company')) &  validateInput($('#charge')) &  validateInput($('#city')) & validateRadio($('#check_policy'))){  
            $('#formQuote').submit();
          }
     });

     $('#btnSendContact').click(function(event) {
          // if(validateInput($('#name_contact')) & validateInput($('#phone_contact')) & validateInput($('#email_contact'))  & validateEmail($('#email_contact')) &  validateInput($('#country_contact'))  &  validateInput($('#city_contact')) &  (validateInput($('#message_contact')) && validateLength($('#message_contact'))) & validateRadio($('#check_policy_contact'))){  
            sendEmailContact();
          // }
     });

     function validateInput(object){
          let valid = true;
          if(object.val() == '' || object.val() == null){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid');
          }else{               
               object.removeClass('not-valid');
               object.addClass('is-valid1');
          }
          return valid;
     } 

     function validateRadio(object){
          let valid = true;
          if (!object.is(':checked')){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid')
          }else{
                object.removeClass('not-valid');
                object.addClass('is-valid1');
          }
          return valid;
     }
     function validateEmail(object){
          let valid = true;
          if(!isValidEmail(object.val())){
            valid = false;
            object.removeClass('is-valid1');
            object.addClass('not-valid');
            }else{
              object.removeClass('not-valid');
              object.addClass('is-valid1');
            }
            return valid;
     }

     function validateLength(object){

          let max = object.data('max');
          console.log('data max enviado es de '  + max)
          let valid = true;          
          if(object.val().length > max){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid');
          }else{               
               object.removeClass('not-valid');
               object.addClass('is-valid1');
          }
          return valid;
     }

     function sendEmailContact(){
        let data = {
          name : $('#name_contact').val(),
          phone : $('#phone_contact').val(),
          email : $('#email_contact').val(),
          country : $('#country_contact').val(),
          city : $('#city_contact').val(),
          message : $('#message_contact').val(),
          _recaptcha : $('#recaptcha_contact').val()
        };
        $.ajax({
               url : baseRoot +'/send-contact',
               type : 'GET',
               dataType : 'json',
               data : data,
               beforeSend: function () {
                    $('.loader').fadeIn();
                    },
               success : function(response){
                    $('.loader').fadeOut();
                    if (response.status == 1) {
                         swal({
                           title: title_send_contact,
                           type: "success",
                           confirmButtonText: "Cerrar",
                           confirmButtonColor: colorBtn

                         });

                        $('#name_contact').val('');
                        $('#phone_contact').val('');
                        $('#email_contact').val('');
                        $('#country_contact').val('');
                        $('#city_contact').val('');
                        $('#message_contact').val('');
                    }else if(response.status == -1){
                         swal({
                         title: title_invalid_recaptcha,
                         type: "error",
                         confirmButtonText: "Cerrar",
                         confirmButtonColor: colorBtn

                         });
                    }else{
                       swal({
                         title: title_error,
                         type: "error",
                         confirmButtonText: "Cerrar",
                         confirmButtonColor: colorBtn

                         });
                    }
            }    
          });
     }

     $('#email_newsletter').keyup(function(event) {
          if(event.which === 13){
            sendNewsletter();       
           }
       });

       $("#send_newsletter").click(function(event) {
          sendNewsletter();  
     })

     function sendNewsletter(){
         var email = $('#email_newsletter').val();
         var _recaptcha = $('#recaptcha_newsletter').val();
         message = '';
         if(email == ''){
              message = required_email;
         }else if(!isValidEmail(email)){
              message = email_invalid;
         }else if(!validateRadio($('#newsletter'))){
            message = 'Debe aceptar las políticas de tratamiento de datos'
         }
         if(message == ''){
           //if(seguir == 1){
           $.ajax({
           url : baseRoot +'/send-newsletter',
           type : 'GET',
           dataType : 'json',
           data : {email : email, _recaptcha : _recaptcha},
           beforeSend: function () {
                $('.loader').fadeIn();
                },
           success : function(response){
                $('#email_newsletter').val('');
                $('.loader').fadeOut();
                if (response.status == 1) {
                     swal({
                     title: title_envio_newsletter,
                     type: "success",
                     confirmButtonText: "Cerrar",
                     confirmButtonColor: colorBtn

                     });
                }else if(response.status == -1){
                     swal({
                     title: title_registered_mail,
                     type: "error",
                     confirmButtonText: "Cerrar",
                     confirmButtonColor: colorBtn

                     });
                }else if(response.status == - 2){
                     swal({
                     title: title_invalid_recaptcha,
                     type: "error",
                     confirmButtonText: "Cerrar",
                     confirmButtonColor: colorBtn

                     });
                }else{
                   swal({
                     title: title_error,
                     type: "error",
                     confirmButtonText: "Cerrar",
                     confirmButtonColor: colorBtn

                     });
                }
           }    
           });
         } else{
         swal({
              title: message,
              type: "error",
              confirmButtonText: "Cerrar",
              confirmButtonColor: colorBtn

         });
        } 
     }      

     function isValidEmail(mail){
          return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
     }
      
      
});
      
      
      
      
      