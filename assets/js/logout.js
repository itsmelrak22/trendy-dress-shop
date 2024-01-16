function logout() {
  $.post("./assets/logout_action.php", {}, function (data) {
    to_dashboard();
    to_Navigation();
  });
}
