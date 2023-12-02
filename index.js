function upload_file()
{
    var regex_file = document.getElementById('regex_file');
    var status = document.getElementById('status');
    var result = document.getElementById('result');
	var file = regex_file.files[0];
	var form_data = new FormData();
	form_data.append("name", file);
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', './upload.php', true);
	xhttp.onload = function()
	{
		if (xhttp.status == 200)
		{
			var json_data = JSON.parse(this.responseText, function (key, value) { return value; });
			status.innerHTML = json_data.status_code; // json_data is [object Object]
			
			// FILL IN YOUR CODE BELOW
			var table = document.querySelector('#result table');

			// delete what is already there
			var initialRowsCount = 3;
    
			// Remove existing rows beyond the initial rows.
			while (table.rows.length > initialRowsCount) {
				table.deleteRow(-1); // Deletes the last row
			}

			const resultArray = json_data['result_sets'];
			console.log(resultArray);


			// For each result in result_sets, add a new row to the table
			for(var i=0 ; i<json_data.result_sets.length; i++){
				var resultText = json_data.result_sets[i];

				var newRow = table.insertRow(-1); // what is the -1 doing? 
				var numCell = newRow.insertCell(0);
				numCell.textContent = i;

				var textCell = newRow.insertCell(1);
				textCell.innerHTML = resultText;
			}

			// FILL IN YOUR CODE ABOVE
		}
	};

	// send the data.
	xhttp.send(form_data);
}

function match_pattern()
{
    var regex_file = document.getElementById('regex_file');
    var regex_text = document.getElementById('regex_text');
    var status = document.getElementById('status');
    var result = document.getElementById('result');
    if (regex_file.files.length == 0)
    	return false;
	var xhttp = new XMLHttpRequest();
	xhttp.open('GET', './regex.php?filename=' + regex_file.files[0].name + '&pattern=' + regex_text.value, true);
	xhttp.onload = function()
	{
		if (xhttp.status == 200)
		{
			var json_data = JSON.parse(this.responseText, function (key, value) { return value; });
			status.innerHTML = json_data.status_code; // json_data is [object Object]

			// FILL IN YOUR CODE BELOW
			var table = document.querySelector('#result table');

			// delete what is already there
			var initialRowsCount = 3;
    
			// Remove existing rows beyond the initial rows.
			while (table.rows.length > initialRowsCount) {
				table.deleteRow(-1); // Deletes the last row
			}
			console.log("result set length = " + json_data.result_sets.length);
			// For each result in result_sets, add a new row to the table
			for(var i=0 ; i<json_data.result_sets.length; i++){
				var resultText = json_data.result_sets[i];

				var newRow = table.insertRow(-1); // what is the -1 doing? 
				var numCell = newRow.insertCell(0);
				numCell.textContent = i;

				var textCell = newRow.insertCell(1);
				textCell.innerHTML = resultText;
			}

			// FILL IN YOUR CODE ABOVE
		}
	};

	// send the data.
	xhttp.send();
}

// this method is reserved for extra credit
function hide_unmatched_results()
{
	// FILL IN YOUR CODE BELOW
	// ...
	// ...
	// ...
	// FILL IN YOUR CODE ABOVE
}

document.getElementById('submit').onclick = upload_file;
document.getElementById('filter').onchange = hide_unmatched_results;

