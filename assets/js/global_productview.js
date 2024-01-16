$(document).ready(function () {
  to_Navigation();
  to_footer()
});
function to_dashboard() {
  localStorage.clear();
 window.location.href="index.php";
}
function to_Navigation() {
  $.post("navigation/nav.php", {}, function (data) {
    $("#nav_content").html(data);
  });
}
function to_footer() {
  $.post("footer_content/footer.php", {}, function (data) {
    $("#footers").html(data);
  });
}
function to_myauction() {
  $.post("pages/myauction/myauction_main.php", {}, function (data) {
    $("#contents").html(data);
  });
}
function to_mybids() {
  $.post("pages/mybids/mybids_main.php", {}, function (data) {
    $("#contents").html(data);
  });
}
function to_aboutus() {
  $.post("pages/aboutus/aboutus_main.php", {}, function (data) {
    $("#contents").html(data);
  });
}
function to_portfolio() {
  $.post("pages/profile/profile_main.php", {}, function (data) {
    $("#contents").html(data);
  });
}




