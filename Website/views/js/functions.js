$(document).ready(init);

function init(ev){
	
	$("#connect-btn").click(showConnectDiv);

	// requestUsers();
	// setTimeout(function(){requestScans()},1000);
	var users = requestUsers();
	for (var i = 0; i < users.length; i++) {
		generateLi(users[i].username);
	}
	$(".user-condensed").click(showDetails);

}

function showDetails(ev){
	$(ev.target).next().animate({
		height: "toggle" 
	}, 500, function() {
		// Animation complete.

	});
}

function showConnectDiv(ev){
	$("#connect-div").animate({
		height: "toggle" 
	}, 500, function() {
		// Animation complete.

	});
}

function requestUsers(){
	var jsonObject = {};
	// var xhttp = new XMLHttpRequest();
	// xhttp.onreadystatechange = function() {
	// 	if (xhttp.readyState == 4 && xhttp.status == 200)
	// 	{
	// 		var json = $.parseJSON(xhttp.responseText);

	// 		jQuery.each(json, function(key, val){
	// 			generateLi(val.username);
	// 		});
	// 		$(".user-condensed").click(showDetails);
	// 	}
	// };
	// xhttp.open("GET", "?action=getAllUsersJson", true);
	// xhttp.send();

	$.ajax({
		async: false,
		url: "?action=getAllUsersJson",
		success: function(r) {
			var json = $.parseJSON(r);
			jsonObject = json;
			// jQuery.each(json, function(key, val){
			// 	htmlString+="<tr class='success'>"+
			// 					"<td>"+val.treasure_id+"</td>"+
			// 					"<td>12:30</td>"+
			// 					"<td>22 min 30 sec</td>"+
			// 				"</tr>";
			// });
		}
	});
	// alert(xhttp.responseText);

	return jsonObject;
}

function requestScans(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{

			// alert(xhttp.responseText)
			var json = $.parseJSON(xhttp.responseText);

			jQuery.each(json, function(key, val){
				var clueCount = json.length;

				generateLi(val.username);
			});
			$(".user-condensed").click(showDetails);
		}
	};
	xhttp.open("GET", "?action=getAllScansJson", true);
	xhttp.send();
}


function requestTreasures(){

	var htmlString = "";
	var jsonObject = {};

	$.ajax({
		async: false,
		url: "?action=getAlltreasuresJson",
		success: function(r) {
			var json = $.parseJSON(r);
			jsonObject = json;
			// jQuery.each(json, function(key, val){
			// 	htmlString+="<tr class='success'>"+
			// 					"<td>"+val.treasure_id+"</td>"+
			// 					"<td>12:30</td>"+
			// 					"<td>22 min 30 sec</td>"+
			// 				"</tr>";
			// });
		}
	});

	return jsonObject;
}

function generateLi(username){

	var treasures = requestTreasures();
	var users = requestUsers();

	var user = {};
	for(var i=0; i < users.length; i++) {
		if (users[i].username == username) {
			user = users[i];
			break;
		}
	}
	if (!user) {
		console.log("user " + username + " not found");
		return;
	}

	var scans = user.scans || {};

	var percentage = Math.floor(scans.length / treasures.length * 100);

	var htmlTemplate = "<li>"+
			"<div class='user-condensed'>"+username+"<span>show detail &#x25BE;</span>"+
				"<div class='progress'>"+
					"<div class='progress-bar' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width:"+percentage+"%'>"+
						percentage +"% Complete"+
					"</div>"+
				"</div>"+
			"</div>"+
			"<div>"+
				"<table class='table'>"+
					"<tr>"+
						"<th>Clue N°</th>"+
						"<th>Scanned at</th>"+
						"<th>Time elapsed since last clue</th>"+
					"</tr>";

	for (var i=0; i < treasures.length; i++) {
		var treasure = treasures[i];
		var user_has_scan;
		for(var j=0; j < scans.length ;j++) {
			if (scans[j].treasure.treasure_id == treasure.treasure_id) {
				user_has_scan = user.scans[j];
				break;
			}
		}

		if (user_has_scan) {
			htmlTemplate += "<tr class='success'>"+
									"<td>"+treasure.treasure_id+"</td>"+
									"<td>"+ user_has_scan.date_scan+"</td>"+
									"<td>22 min 30 sec</td>"+
								"</tr>";
		} else {
			htmlTemplate += "<tr>"+
									"<td>"+treasure.treasure_id+"</td>"+
									"<td>Not found</td>"+
									"<td>22 min 30 sec</td>"+
								"</tr>";
		}
					
	}

			htmlTemplate +=	"</table>"+
			"</div>"+
		"</li>";


	$("#users-list").append(htmlTemplate);
}