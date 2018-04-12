uid = -1;
name = "Guest";
friends = [];

$.ajax({
  async: false,
  url: "scripts/get_user_id.php",
  success: function(response) {
    uid = parseInt(response);
  }
});

$.ajax({
  async: false,
  url: "scripts/get_name.php?id=" + uid,
  success: function(response) {
    name = response;
  }
});

$.ajax({
  async: false,
  url: "scripts/get_user_data.php?param=friends",
  success: function(response) {
    friends = response.split(",")
  }
});
