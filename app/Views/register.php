<!DOCTYPE html>
<html>

<head>
	<title>Register for job information</title>
</head>

<body>
	<h1>Register for job information</h1>
	<form method="post" onsubmit="return validateForm()">
		<label for="work_name">Work Name:</label><br>
		<input required type="text" id="work_name" name="work_name"><br>

		<label for="starting_date">Starting Date:</label><br>
		<input required type="date" id="starting_date" name="starting_date"><br>

		<label for="ending_date">Ending Date:</label><br>
		<input required type="date" id="ending_date" name="ending_date"><br>

		<label for="status">Status:</label><br>
		<select required id="status" name="status">
			<option value="1">Planning</option>
			<option value="2">Doing</option>
			<option value="3">Complete</option>
		</select><br><br>

		<input type="submit" value="Create">
	</form>
	<a href="/">List</a>
</body>

</html>
<script>
	function validateForm() {
		var startDate = document.getElementById("starting_date").value;
		var endDate = document.getElementById("ending_date").value;

		if (startDate >= endDate) {
			alert("The start date must be less than the end date!");
			return false;
		}
		return true;
	}
</script>