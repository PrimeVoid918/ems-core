<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body style="text-align: center; border: 1px solid black">
  <h2>Name: <?= htmlspecialchars($firstname) ?> <?= htmlspecialchars($lastname) ?></h2>
</body>

</html>