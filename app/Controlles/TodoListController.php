<?php
require_once "../Models/connectDB.php";

class TodoListController
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnect();
    }

    function destroy()
    {
        $res = $this->db->deleteTodoList(explode("/", $_SERVER['REQUEST_URI'])[2]);
        if ($res) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function index()
    {
        $work =  $this->db->showAllTodoList();
        if ($work) {
            extract(compact('work'));
            include "../Views/index.php";
        }
    }

   
    public function create()
    {
        require_once "../Views/register.php";
    }

   
    public function store()
    {
        if (isset($_POST)) {
            $work_name = $_POST['work_name'];
            $starting_date = $_POST['starting_date'];
            $ending_date = $_POST['ending_date'];
            $status = $_POST['status'];
            $res = $this->db->addTodoList($work_name, $starting_date, $ending_date, $status);
            if ($res) {
                header("Location: " . $_SERVER['HTTP_ORIGIN']);
            }
        }
    }

   
    public function show()
    {
        $work = $this->db->showTodoListById(explode("/", $_SERVER['REQUEST_URI'])[2]);
        if ($work) {
            extract(compact('work'));
            include "../Views/edit.php";
        }
    }


    public function update()
    {
        if (isset($_POST)) {
            $id = $_POST['id'];
            $work_name = $_POST['work_name'];
            $starting_date = $_POST['starting_date'];
            $ending_date = $_POST['ending_date'];
            $status = $_POST['status'];
            $res = $this->db->editTodoList($id, $work_name, $starting_date, $ending_date, $status);
            if ($res) {
                header("Location: " . $_SERVER['HTTP_ORIGIN']);
            }
        }
    }

    public function calendar(){
        include "../Views/calendar.php";
    }

    public function ApiGetAllTodoList(){
        $work =  $this->db->showAllTodoList();
        echo json_encode($work);
    }
}
