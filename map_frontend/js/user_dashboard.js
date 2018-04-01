$(function(){
	httpGetAsync("scripts/get_user_data.php", function(e){
		e = JSON.parse(e);

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
