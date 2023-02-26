<!DOCTYPE html>
<html>
<head>
<title>Update for job information</title>

</head>
<body>
	<h1>Update for job information</h1>
	<form method="post" action="#">
    <input type="hidden" name="id" value="<?php echo $work['id']; ?>">
    <label for="work_name">Work name:</label>
    <input type="text" name="work_name" id="work_name" value="<?php echo $work['work_name']; ?>"><br>

    <label for="starting_date">Starting date:</label>
    <input type="date" name="starting_date" id="starting_date" value="<?php $date = date_create($work['starting_date']); echo date_format($date,"Y-m-d"); ?>"><br>

    <label for="ending_date">Ending date:</label>
    <input type="date" name="ending_date" id="ending_date" value="<?php $date = date_create($work['ending_date']); echo date_format($date,"Y-m-d"); ?>"><br>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="0" <?php if ($work['status'] == 0) {echo 'selected';} ?>>Planning</option>
        <option value="1" <?php if ($work['status'] == 1) {echo 'selected';} ?>>Doing</option>
        <option value="2" <?php if ($work['status'] == 1) {echo 'selected';} ?>>Complete</option>
    </select><br>

    <input type="submit" value="Save">
</form>
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
