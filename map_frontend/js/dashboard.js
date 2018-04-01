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

function add_events(events, num_events, e, f)
{
	var elements = [];
	var expected = events.length;

	today = new Date().setHours(0,0,0,0);

	events.forEach(function(e){
		httpGetAsync("scripts/get_event_data.php?id="+e, function(data){
			expected -= 1;
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

			if (date > today)
			{
				optionalTag = "event-future";
			}
			else
			{
				optionalTag = "event-past";
			}

			element = '<label class="event ' + optionalTag + '"> \
				<div class="event-name">' + data["name"] + '<span>' +
				formatDate(date) + '</span></div>' + optionalTimes +  
				optionalDesc + '<a href="edit_event.php?id=' + 
				data["id"] + '" info="' + data["id"] + '" class="edit-event-button"><div id="edit-event"></div></a></label>';

			index = 0;
			while (index < elements.length && date < elements[index][0])
			{
				index += 1;
			}
			elements.splice(index, 0, [date, element]);

			if (expected == 0)
			{
				elements.forEach(function(e){
					$("#events-container").append(e[1]);
				});
				f();
			}
		});
	});

}