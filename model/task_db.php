<?php

function get_tasks_by_category($category_id)
{
    global $db;
    if($category_id){
        $query = 'SELECT A.ItemNum, A.Title, A.Description, B.categoryName FROM todoitems A
        JOIN categories B ON A.categoryID = B.categoryID
        WHERE a.categoryID = :category_id ORDER BY ItemNum';
    }
    else {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, B.categoryName FROM todoitems A
        JOIN categories B ON A.categoryID = B.categoryID ORDER BY ItemNum';
    }
    $statement = $db->prepare($query);
    if($category_id){
        $statement -> bindValue(':category_id', $category_id);
    }
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function delete_task($task_id)
{
    global $db;
    $query = 'DELETE FROM todoitems
                WHERE ItemNum = :task_id';
    $statement = $db->prepare($query);
    $statement -> bindValue(':task_id', $task_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_task($title, $des, $category_id)
{
    global $db;
    $query = 'INSERT INTO todoitems (Title,	Description, categoryID)
                VALUES (:title, :des, :category_id)';
    $statement = $db->prepare($query);
    $statement -> bindValue(':title', $title);
    $statement -> bindValue(':des', $des);
    $statement -> bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

?>