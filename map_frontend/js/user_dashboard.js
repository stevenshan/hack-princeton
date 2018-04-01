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
		num_events = events.length;

		$(".event_count").html("(" + num_events + ")");

		add_events(events, num_events, e);
	});
});
