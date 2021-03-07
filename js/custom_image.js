function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#display-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
  $("#fileInput").change(function(){
      $("#where-replace > span").replaceWith( "<img data-img='' class='img-fluid' id='display-image'/>" );
      readURL(this); 
});