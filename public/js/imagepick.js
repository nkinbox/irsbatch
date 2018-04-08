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
    $('#sa_checkbox').change(function() {
        var checkboxes = $('[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
  
    });
      $(".upload-button1").on('click', function() {
       $(".file-upload1").click();
  
    });
    $("#addNewDoc").on('click', function(e){
        e.preventDefault();
        var i = $("#docsContainer").children().length;
        $("#docsContainer").append('<div class="col-md-3" style="padding-top:2em"><div class="form-group"><label class="active">Document Name</label><input type="text"  class="form-control" name="docs_name[' + i + ']" placeholder="Document Name" required><input type="file"  class="form-control" name="docs[' + i + '][]" multiple required></div></div>');
    });
    $("#loan_range").on('change', function(){
        var i, j = 0;
        switch (this.value) {
            case "1":
                j = 5;
                break;
            case "2":
                j = 10;
                break;
            case "3":
                j = 12;
                break;
            case "4":
                j = 15;
                break;
            case "5":
                j = 20;
                break;
            case "6":
                j = 25;
        }
        $("#ChequeContainer").html("");
        for(i = 1; i <= j; i++)
        $("#ChequeContainer").append('<div class="col-md-3"><div class="form-group"><label class="active">'+ i +'. Cheque Number</label><input type="number" class="form-control" name="cheque_number['+ i +']" placeholder="Cheque Number"></div></div>');
    });
    $("#loan_range1").on('change', function(){
        var i, j = 0;
        switch (this.value) {
            case "1":
                j = 5;
                break;
            case "2":
                j = 10;
                break;
            case "3":
                j = 12;
                break;
            case "4":
                j = 15;
                break;
            case "5":
                j = 20;
                break;
            case "6":
                j = 25;
        }
        $("#ChequeContainer").html("");
        for(i = 1; i <= j; i++)
        $("#ChequeContainer").append('<div class="col-md-3"><div class="form-group"><label class="active">'+ i +'. Cheque Number</label><input type="number" class="form-control" name="cheque_number['+ i +']" placeholder="Cheque Number"><input type="date" name="cheque_date['+ i +']" class="form-control"><input type="number" name="cheque_amount['+ i +']" class="form-control" placeholder="Cheque Amount"></div></div>');
    });
    var address = document.getElementById("Address");
    var len_of_address=0;
    if(address != undefined) {
        len_of_address = address.value.length;
        address.addEventListener('input', function() {
            if (address.value.length != len_of_address) {
                var i = $("#docsContainer").children().length;
                if(i == 0) {
                    $("#docsContainer").append('<div class="col-md-3" style="padding-top:2em"><div class="form-group"><label class="active">Document Name</label><input type="text"  class="form-control" name="docs_name[' + i + ']" placeholder="Document Name" value="Address Proof" required><input type="file"  class="form-control" name="docs[' + i + '][]" multiple required></div></div>');
                }
            }
        });
    }
  });
  $("#addNewCheque").on('click', function(e){
    e.preventDefault();
    var i = $("#ChequeContainer").children().length;
    var j = i + 1;
    //$("#ChequeContainer").append('<div class="col-md-3"><div class="form-group"><label class="active">'+ j +'. Cheque Number</label><input type="number" class="form-control" name="cheque_number['+ i +']" placeholder="Cheque Number"><input type="date" name="cheque_date['+ i +']" class="form-control"><input type="number" name="cheque_amount['+ i +']" class="form-control" placeholder="Cheque Amount"></div></div>');
    $("#ChequeContainer").append('<div class="col-md-3"><div class="form-group"><label class="active">'+ j +'. Cheque Number</label><input type="number" class="form-control" name="cheque_number['+ i +']" placeholder="Cheque Number"></div></div>');
});