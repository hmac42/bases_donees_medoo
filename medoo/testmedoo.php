<?php
include_once ("Medoo.php");
 
// Using Medoo namespace
use Medoo\Medoo;
 
// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'medoo_n2_exo',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
 
// Enjoy
/*$database->insert('utilisateurs', [
    'nomU' => 'foo',
    'email' => 'foo@bar.com'
]);
 
$data = $database->select('connexions', [
    'nomU',
    'email'
], [
    'user_id' => 2
]);
 
echo json_encode($data);*/
 
// [
//     {
//         "user_name" : "foo",
//         "email" : "foo@bar.com"
//     }
// ]
?>