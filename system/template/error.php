<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?= ERROR_LEVELS[$_level]; ?></p>
    <p><?= $_message; ?></p>
    <p><?= $_file; ?></p>
    <p><?= $_line; ?></p>
</body>
</html>