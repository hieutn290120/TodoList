<?php
// Khai báo đường dẫn thư mục gốc
require_once "../Models/connectDB.php";
require_once  "../Controlles/TodoListController.php";

$db = new DBConnect();
$controler = new TodoListController();
