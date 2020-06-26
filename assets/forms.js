
$(document).ready(function () {
    
    $("#password_visibility").click(function(){
        var pass_input = document.getElementById("passwd_user");
        if (pass_input.type === "password") {
            pass_input.type = "text";
            $(this).removeClass("fa-eye").addClass("fa-eye-slash")
        } else {
            pass_input.type = "password";
            $(this).removeClass("fa-eye-slash").addClass("fa-eye")
        }
    });
   
    $('#frmHeader').submit(function() {
       var status = confirm("Click OK to continue process?");
       if(status == false){
            return false;  //alert('Ga Jadi');
       }else{
            return true;   //alert('Jadi');
       }
    });


});
