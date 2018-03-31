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

function formatDate(date) {
	var monthNames = [
		"January", "February", "March",
		"April", "May", "June", "July",
		"August", "September", "October",
		"November", "December"
	];

	var day = date.getDate();
	var monthIndex = date.getMonth();
	var year = date.getFullYear();

	return monthNames[monthIndex] +  ' ' + day + ', ' + year;
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

		events.forEach(function(e){
			httpGetAsync("scripts/get_event_data.php?id="+e, function(data){
				data = JSON.parse(data);
				content = JSON.parse(data["data"]);

				date = new Date(data["date"]);

				if (content["start"] != "" && content["end"] != "")
				{
					optionalTimes = '<div class="event-desc">Starts at ' + 
									content["start"] + ', Ends at ' + 
									content["end"] + '</div>';
				}
				else if (content["start"] != "" && content["end"] == "")
				{
					optionalTimes = '<div class="event-desc">Starts at ' + 
									content["start"] + '</div>';
				}
				else if (content["start"] == "" && content["end"] != "")
				{
					optionalTimes = '<div class="event-desc">Ends at ' + 
									content["end"] + '</div>';
				}
				else
				{
					optionalTimes = "";
				}

				if (content["description"] != "")
				{
					optionalDesc = '<div class="event-right">' + content["description"] + '</div>';
				}
				else
				{
					optionalDesc = "";
				}

				element = '<label class="event"> \
					<div class="event-name">' + data["name"] + '<span>' +
					formatDate(date) + '</span></div>' + optionalTimes +  
					optionalDesc + '</label>';
				console.log(content);
				$("#events-container").append(element);
			})
		});
	});
});
