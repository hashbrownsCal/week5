<?php
    require("./model/database.php");
    require("./model/task_db.php");
    require("./model/category_db.php");

    $category_id = filter_input(INPUT_POST,'category_id');
    if ($category_id == NULL) {
        $category_id = filter_input(INPUT_GET,'category_id');
    }
    $category_name = filter_input(INPUT_POST,'category_name');
    if ($category_name  == NULL) {
        $category_name  = filter_input(INPUT_GET,'category_name');
    }
    $task_id = filter_input(INPUT_POST,'task_id');
    if ($task_id == NULL) {
        $task_id = filter_input(INPUT_GET,'task_id');
    }
    $title = filter_input(INPUT_POST,'title');
    if ($title == NULL) {
        $title = filter_input(INPUT_GET,'title');
    }
    $description = filter_input(INPUT_POST,'description');
    if ($task_id == NULL) {
        $task_id = filter_input(INPUT_GET,'description');
    }

    $action = filter_input(INPUT_POST,'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET,'action');
        if ($action == NULL) {
            $action = 'list_tasks';
        }
    }

switch($action) {
    case "list_categories":
        $categories = get_categories();
        include("category_list.php");
        break;
    case "add_category":
        add_category($category_name);
        header("Location: .?action=list_tasks");
        break;
    case "add_task":
        if ($category_id && $description) {
            add_task($title, $description, $category_id);
            header("Location: .?category_id=$category_id");
        } else {
            $error = "Invalid task data. Check all fields and try again.";
        include('view/error.php');
            exit();
        }
        break;
    case "delete_category":
        if ($category_id) {
            try {
                delete_category($category_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a category if tasks exist for it.";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_tasks");
        }
        break;
    case "delete_task":
        if ($task_id) {
            delete_task($task_id);
            header("Location: .?category_id=$category_id");
        } else {
            $error = "Missing or incorrect task id.";
            include('view/error.php');
        }
        break;
    default:
        $category_name = get_category($category_id);
        $categories = get_categories();
        $tasks = get_tasks_by_category($category_id);
        include('task_list.php');
}

?>