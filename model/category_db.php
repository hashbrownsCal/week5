<?php

function get_categories()
{
    global $db;
    $query = 'SELECT * FROM categories';
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function get_category($category_id)
{
    if (!$category_id) {
        return "All Categories";
    }
    global $db;
    $query = 'SELECT * FROM categories
                WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement -> bindValue(':category_id', $category_id);
    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();
    $results_name = $results['categoryName'];
    return $results_name;
}

function delete_category($category_id)
{
    global $db;
    $query = 'DELETE FROM categories
                WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement -> bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_category($categoryName)
{
    global $db;
    $query = 'INSERT INTO categories (categoryName)
                VALUES (:categoryName)';
    $statement = $db->prepare($query);
    $statement -> bindValue(':categoryName', $categoryName);
    $statement->execute();
    $statement->closeCursor();
}

?>