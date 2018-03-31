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

// load number of organizations
httpGetAsync("scripts/get_user_data.php?param=organizations", function(e){
	orgs = e.split(",");
	if (e == "")
	{
		orgs = [];
	}
	console.log(orgs);

	$("#num_orgs").html(orgs.length);

	orgs.forEach(function(e){
		httpGetAsync("scripts/get_org_data.php?id=" + e + "&param=name", function(name){
			httpGetAsync("scripts/get_org_data.php?id=" + e + "&param=users", function(users){
				httpGetAsync("scripts/get_org_data.php?id=" + e + "&param=data", function(data){
					add_org(name, users, data);
				});
			});
		});
	});
});

function add_org(name, users, data)
{
	users = users.split(",");
	raw = '<div class="media text-muted pt-3"> \
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded"> \
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray"> \
            <div class="d-flex justify-content-between align-items-center w-100"> \
              <strong class="text-gray-dark">' + name + '</strong> \
              <a href="#">Expand</a> \
            </div> \
          </div> \
        </div>';
    $("#orgs_list").append(raw);
}