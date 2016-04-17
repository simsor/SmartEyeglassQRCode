$(document).ready(init);

function init(ev){
	
	$("#connect-btn").click(showConnectDiv);

	// requestUsers();
	// setTimeout(function(){requestScans()},1000);
	requestScans();

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

// function requestUsers(){
// 	var xhttp = new XMLHttpRequest();
// 	xhttp.onreadystatechange = function() {
// 		if (xhttp.readyState == 4 && xhttp.status == 200)
// 		{
// 			var json = $.parseJSON(xhttp.responseText);

// 			jQuery.each(json, function(key, val){
// 				generateLi(val.username);
// 			});
// 			$(".user-condensed").click(showDetails);
// 		}
// 	};
// 	xhttp.open("GET", "?action=getAllUsersJson", true);
// 	xhttp.send();
// 	// alert(xhttp.responseText);
// }

function requestScans(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			// = xhttp.responseText;
			// fill tables
			alert(xhttp.responseText)

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

function generateLi(username){
	var htmlTemplate = "<li>"+
			"<div class='user-condensed'>"+username+"<span>show detail &#x25BE;</span>"+
				"<div class='progress'>"+
					"<div class='progress-bar' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width:40%'>"+
						"40% Complete"+
					"</div>"+
				"</div>"+
			"</div>"+
			"<div>"+
				"<table class='table'>"+
					"<tr>"+
						"<th>Clue N°</th>"+
						"<th>Scanned at</th>"+
						"<th>Time elapsed since last clue</th>"+
					"</tr>"+
					"<tr class='success'>"+
						"<td>1</td>"+
						"<td>12:30</td>"+
						"<td>22 min 30 sec</td>"+
					"</tr>"+
					"<tr class='success'>"+
						"<td>1</td>"+
						"<td>12:30</td>"+
						"<td>22 min 30 sec</td>"+
					"</tr>"+
					"<tr>"+
						"<td>1</td>"+
						"<td>12:30</td>"+
						"<td>22 min 30 sec</td>"+
					"</tr>"+
					"<tr>"+
						"<td>1</td>"+
						"<td>12:30</td>"+
						"<td>22 min 30 sec</td>"+
					"</tr>"+
				"</table>"+
			"</div>"+
		"</li>"


	$("#users-list").append(htmlTemplate);
}