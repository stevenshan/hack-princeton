$(function(){
	httpGetAsync("scripts/get_user_data.php", function(e){
		e = JSON.parse(e);

		thumbnail_url="/imgs/user" + e["thumbnail"] + ".png";
		$("header").prepend("<img id=\"thumbnailimg\" src=\"" + thumbnail_url + "\">");

		events = e["events"].split(",");
		if (e["events"] == "")
		{
			events = [];
		}

		friends = e["friends"].split(",");
		if (e["friends"] == "")
		{
			friends = [];
		}

		num_events = events.length;
		num_friends = friends.length;

		$(".event_count").html("(" + num_events + ")");


		$("#friends-bar-left").html(num_friends + " friends");

		add_events(events, num_events, e);
	});
});

$("#friend-search").submit(function(){
	url="/scripts/add_friend.php?query=" + $("#friend-name").val();
	console.log(url);
	httpGetAsync(url, function(e){
		console.log(e);
		if (e.length ==0 || e.charAt(0) == "1")
		{
			alert("Friend request was sent");
		}
		else
		{
			alert(e);
		}
	});
	return false;
});