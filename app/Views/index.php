<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Work Name</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($work as $val) : ?>
                <tr>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['work_name']; ?></td>
                    <td><?php $date = date_create($val['starting_date']); echo date_format($date,"d-m-Y"); ?></td>
                    <td><?php $date = date_create($val['ending_date']); echo date_format($date,"d-m-Y"); ?></td>
                    <td><?php echo $val['status']; ?></td>
                    <td>
                        <a href="delete/<?= $val['id'] ?>">Delete</a>
                        <a href="edit/<?= $val['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create">Register</a>
    <a href="calendar">Calendar</a>
</body>

</html>