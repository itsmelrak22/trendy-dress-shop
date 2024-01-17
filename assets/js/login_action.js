// $(document).ready(function () {
//   $("#login-form").submit(function (e) {
//     e.preventDefault();
    
//     loginAction();
//   });
// });

function loginAction() {
  btnDisable("#loginbtnID", true);
  $.post(
    "./assets/login_action.php",
    {
      email: $("#username_text").val(),
      pass: $("#pass_text").val(),
    },
    function (data) {
      console.log(data);
      if (data === "success") {
        alert("Login Successfully");
        to_dashboard()
        to_Navigation()
      } else {
        alert("Email and Password does not match.");
        btnDisable("#loginbtnID", false);
      }
    }
  );
}
function btnDisable(element, type) {
  $(element).prop("disabled", type);
}
