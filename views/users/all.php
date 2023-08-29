<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($users as $user) { ?>
            <p><?php echo $user['full_name'] ?></p>
    <?php    } ?>

</body>
</html>