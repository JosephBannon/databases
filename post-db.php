<?php

function getAllPosts() {
    global $db;
    $query = "SELECT e.postId, e.postTitle, e.username, e.postContent, e.timePosted, e.rating, Course.name AS courseName, 
        Professor.firstName AS profFirstName, Professor.lastName AS profLastName FROM 
            (SELECT * FROM Post NATURAL JOIN associated_course NATURAL JOIN associated_prof ORDER BY Post.timePosted DESC) 
        AS e JOIN Course JOIN Professor WHERE e.courseID = Course.courseID AND e.profID = Professor.profID";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getPostsByCourse($courseId) {
    global $db;
    $query = "SELECT e.postId, e.postTitle, e.username, e.postContent, e.timePosted, e.rating, Course.name AS courseName, 
        Professor.firstName AS profFirstName, Professor.lastName AS profLastName FROM 
            (SELECT * FROM Post NATURAL JOIN associated_course NATURAL JOIN associated_prof ORDER BY Post.timePosted DESC) 
        AS e JOIN Course JOIN Professor WHERE e.courseID = Course.courseID AND e.profID = Professor.profID AND Course.courseID = $courseId";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getAllCourses() {
    global $db;
    $query = "SELECT * FROM Course";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getAllProfs() {
    global $db;
    $query = "SELECT * FROM Professor";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}
?>