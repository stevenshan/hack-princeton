uid = -1;
name = "Guest";

$.ajax({
  async: false,
  url: "/scripts/get_user_id.php",
  success: function(response) {
    uid = parseInt(response);
  }
});

$.ajax({
  async: false,
  url: "/scripts/get_name.php?id=" + uid,
  success: function(response) {
    name = response;
  }
});
