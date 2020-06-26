
$(document).ready(function () {
  
   $('.dtYMD').datepicker({  // Format Y-m-d
      Default: false, 
      format: 'yyyy-mm-dd', 
      autoclose: true,  
      autoSize: true, 
      todayHighlight: true  
    }).datepicker('setDate', 'today');

   $('.dtMY').datepicker({  // Format m-Y
      format: "mm-yyyy",
      autoclose: true,  autoSize: true,
      showOn: "button", viewMode: "months", 
      minViewMode: "months"
   }).datepicker('setDate', 'today');

  $('.dtYYYY').datepicker({  // Format YYYY
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
   }).datepicker('setDate', 'today');
   
   $('.dtYMDedit').datepicker({  // Format Y-m-d
     Default: false, 
     format: 'yyyy-mm-dd', 
     autoclose: true,  
     autoSize: true, 
     todayHighlight: true  
  });

  $('.dtMYedit').datepicker({  // Format m-Y
      format: "mm-yyyy",
      autoclose: true,  autoSize: true,
      showOn: "button", viewMode: "months", 
      minViewMode: "months"
   });

  $('.dtYYYYedit').datepicker({  // Format YYYY
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
   });

});
