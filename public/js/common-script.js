
    $(document).ready(function() 
    {
      $(".bss_select").select2();
    });

    Swal.bindClickHandler();
    var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });


    function successtoast(message){
        toastMixin.fire({
            animation: true,
            title: message
        });
    }

    function errortoast(message){
        toastMixin.fire({
            title: message,
            icon: 'error'
           
        });
    }
    
// Image preview on edit
var previewImageBSS = function(event) {
 var output = document.getElementById('bss_image_preview');
 if (output) {
   output.src = URL.createObjectURL(event.target.files[0]);
   output.onload = function() {
     URL.revokeObjectURL(output.src) // free memory
   }
 }
};

$(document).on('change', ".bss_image_change",  function(event) { 
    let image_preview = $(this).closest('.row').find('#bss_image_preview').length ? $(this).closest('.row').find('#bss_image_preview') : '';
  
    if (image_preview != '') {
      image_preview.attr('src', URL.createObjectURL(event.target.files[0]));
      image_preview.on('load',  function() {
        URL.revokeObjectURL(image_preview.attr('src')) // free memory
      }); 
    }
  });


  if ($(".bss_editor").length) {
    ClassicEditor
      .create( document.querySelector( '.bss_editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'blockQuote', '|', 'undo', 'redo' ],
      })
      .catch( error => {
          console.error( error );
      });
  }


