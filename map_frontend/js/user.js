uid = -1;
name = "Guest";
ip = "10.25.53.76";

$.ajax({
  async: false,
  url: "http://" + ip + "/scripts/get_user_id.php",
  success: function(response) {
    uid = parseInt(response);
  }
});

$.ajax({
  async: false,
  url: "http://" + ip + "/scripts/get_name.php?id=" + uid,
  success: function(response) {
    name = response;
  }
});
