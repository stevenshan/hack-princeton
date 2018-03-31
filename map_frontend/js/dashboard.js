function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
}

$(function(){
	httpGetAsync("scripts/get_org_data.php", function(e){
		e = JSON.parse(e);

		events = e["events"].split(",");
		if (e["events"] == "")
		{
			events = []
		}
		num_events = events.length
		
		$(".event_count").html("(" + num_events + ")")
	});
});
