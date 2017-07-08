$(function() {
  $(".button").click(function() {
      $.ajax({
        url: 'loader.php?a=UserController.User.register',
        type: "post",
        data:  $('#vform').serialize(),
        success: function(response) {
          console.log(response);
          $('#submitted').html("<div id='message'></div>");
          $('#message').html("<h2>Contact Form Submitted!</h2>")
          .append("<p>hasta la vista bitch</p>")
          .hide()
          .fadeIn(1500, function() {
            $('#message')
          });
        },
        error: function(error){
          console.log(error);
        }
      });
    return false;
  });
});
