<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
# When installed via composer
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
for ($i = 0; $i < 10; $i++) {
  echo $faker->name, "\n";
} ?>
</body>
</html>