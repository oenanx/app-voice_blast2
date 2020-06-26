
$(document).ready(function () {
    
    $('[rel="mytips"]').tooltip({html:true}); 

    $(document).on('click', '#viewModal', function (){    
    //alert($invoice_id);   
      //var $url_id = $(this).attr("data-href");
      //$(this).attr("data-title");
      $('.modal-dialog').css({width:'90%',height:'auto', 'max-height':'100%'});
      $('.modal-title').html('<b>'+$(this).attr("data-title")+'<b>');
      $('.modal-body').load($(this).attr("data-href"),function(result){
      
        $('#myModal').modal({show:true});
      })    
    });
   
    // $('#frmHeader').submit(function() {
    //    var status = confirm("Click OK to continue process?");
    //    if(status == false){
    //         return false;  //alert('Ga Jadi');
    //    }else{
    //         return true;   //alert('Jadi');
    //    }
    // });


});
