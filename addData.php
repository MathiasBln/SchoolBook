<?php

require_once 'vendor/autoload.php';

use Faker\Factory;

$faker = Faker\Factory::create();

$dbname = 'db_schoolbook';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE `schools` ");
$pdo->exec("TRUNCATE TABLE `users` ");
$pdo->exec("TRUNCATE TABLE `pages` ");
$pdo->exec("TRUNCATE TABLE `posts` ");
$pdo->exec("TRUNCATE TABLE `groups` ");
$pdo->exec("TRUNCATE TABLE `users_has_pages` ");
$pdo->exec("TRUNCATE TABLE `relation` ");
$pdo->exec("TRUNCATE TABLE `groups_has_users` ");
$pdo->exec("TRUNCATE TABLE `comments` ");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");


for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO schools (`name`) VALUES ('{$faker->cityPrefix}{$faker->streetName}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $word = $faker->word;
    var_dump($word);
    $test = password_hash($word, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (`username`, `last_name`, `email`, `password`, `ip`, `token`, `schools_id`) VALUES ('{$faker->firstname}','{$faker->lastname}','{$faker->email}','$test','{$faker->ipv4}','{$faker->ipv4}','{$faker->numberBetween(1,10)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO pages (`title`, `description`, `image`, `banner`) VALUES ('{$faker->text(20)}','{$faker->text(200)}', '{$faker->imageUrl($width = 640, $height = 480)}' , '{$faker->imageUrl($width = 640, $height = 480)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO posts (`content`, `image`, `users_iduser`, `pages_idpages`) VALUES ('{$faker->text(200)}', '{$faker->imageUrl($width = 640, $height = 480)}', '{$faker->numberBetween(1,10)}', '{$faker->numberBetween(1,10)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO groups (`name`, `description`, `image`, `status`) VALUES ('{$faker->text(20)}','{$faker->text(200)}', '{$faker->imageUrl($width = 640, $height = 480)}' , '{$faker->numberBetween(0,1)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO posts (`content`, `image`, `users_iduser`, `groups_idgroups`) VALUES ('{$faker->text(200)}', '{$faker->imageUrl($width = 640, $height = 480)}', '{$faker->numberBetween(1,10)}', '{$faker->numberBetween(1,10)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO users_has_pages (`users_iduser`, `pages_idpages`, `status`) VALUES ('{$faker->numberBetween(1,10)}','{$faker->numberBetween(1,10)}','{$faker->numberBetween(0,1)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 25; $i++){
    $query = "INSERT INTO relation (`user_one`, `user_two`) VALUES ('{$faker->numberBetween(1,10)}','{$faker->numberBetween(1,10)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 25; $i++){
    $query = "INSERT INTO groups_has_users (`groups_idgroups`, `users_iduser`, `status`) VALUES ('{$faker->numberBetween(1,10)}','{$faker->numberBetween(1,10)}','{$faker->numberBetween(0,1)}')";
    $statement = $pdo->exec($query);
};

for ($i = 0; $i < 10; $i++){
    $query = "INSERT INTO comments (`comment`, `posts_idposts`, `posts_users_iduser`) VALUES ('{$faker->text(200)}', '{$faker->numberBetween(1,10)}', '{$faker->numberBetween(1,10)}')";
    $statement = $pdo->exec($query);
};
