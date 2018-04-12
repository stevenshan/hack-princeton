
$(function(){
	httpGetAsync("scripts/get_user_data.php", function(e){
		e = JSON.parse(e);

		hours = parseInt(e["hours"]);
		goal = parseInt(e["goal"]);

		$("#progress-bar").css("width", String(hours / goal * 100) + "%");
		$("#progress-bar").html("<p>" + String(hours / goal * 100) + "% </p>");

		thumbnail_url="imgs/user" + e["thumbnail"] + ".png";
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

		num_friend_requests = 0;
		num_friends = 0;
		friends.forEach(function(e){
			n = "";
			if (e.charAt(0) == "#")
			{
				num_friend_requests += 1;
				n = e.substring(1);
			}
			else
			{
				num_friends += 1;
				n = e;
			}
			httpGetAsync("scripts/get_name.php?id=" + n, function(data){
				if (e.charAt(0) == "#")
				{
					msg = '<div class="friend">' + data +
						'<div class="friend-choice"><div class="choice-accept" onclick="faccept(' + n + ')"></div><div class="choice-reject" onclick="freject(' + n + ')"></div></div> \
					</div>';
				}
				else
				{
					msg = '<div class="friend">' + data +  '</div>';
				}
				$("#friends-container").append(msg);
			});
		});

		$(".event_count").html("(" + num_events + ")");


		$("#friends-bar-left").html(num_friends + " friends &nbsp; | &nbsp;" +
									num_friend_requests + " friend requests");

		add_events(events, num_events, e, function(){
			$(".edit-event-button").click(function(){
				httpGetAsync("scripts/drop_user_from_event.php?id=" + $(this).attr("info"), function(){
					location.reload();
				})
				return false;
			})
		});

	});

});

function faccept(id)
{
	httpGetAsync("scripts/confirm_friend.php?reject=false&friend=" + id, function(e){
		location.reload();
	});
}

function freject(id)
{
	httpGetAsync("scripts/confirm_friend.php?reject=true&friend=" + id, function(e){
		location.reload();
	});
}


$("#friend-search").submit(function(){
	url="scripts/add_friend.php?query=" + $("#friend-name").val();
	httpGetAsync(url, function(e){
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
