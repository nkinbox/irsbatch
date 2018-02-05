$(document).ready(function() {


    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
  
  
    $(".file-upload").on('change', function(){
        readURL(this);
    });
      $(".file-upload1").on('change', function(){
        input=this;
       if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function (e) {
                $('.profile-pic1').attr('src', e.target.result);
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    });
  
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
  
    });
      $(".upload-button1").on('click', function() {
       $(".file-upload1").click();
  
    });
  });