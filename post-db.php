<?php

function getAllPosts() {
    global $db;
    $query = "  SELECT e.postId, e.postTitle, e.username, e.postContent, e.timePosted, e.rating, Course.name AS courseName, 
                Professor.firstName AS profFirstName, Professor.lastName AS profLastName FROM 
                    (SELECT Post.postID, Post.postTitle, Post.username, Post.postContent, Post.timePosted, Post.rating, associated_prof.profID, associated_course.courseID
                    FROM Post LEFT JOIN associated_prof ON Post.postID=associated_prof.postID LEFT JOIN associated_course ON Post.postID=associated_course.postID) 
                AS e LEFT JOIN Course ON e.courseID = Course.courseID 
                LEFT JOIN Professor ON e.profID = Professor.profID
                ORDER BY e.timePosted DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getPostsByCourse($courseId) {
    global $db;
    $query = "  SELECT e.postId, e.postTitle, e.username, e.postContent, e.timePosted, e.rating, Course.name AS courseName, 
                Professor.firstName AS profFirstName, Professor.lastName AS profLastName FROM 
                    (SELECT Post.postID, Post.postTitle, Post.username, Post.postContent, Post.timePosted, Post.rating, associated_prof.profID, associated_course.courseID
                    FROM Post LEFT JOIN associated_prof ON Post.postID=associated_prof.postID LEFT JOIN associated_course ON Post.postID=associated_course.postID) 
                AS e LEFT JOIN Course ON e.courseID = Course.courseID 
                LEFT JOIN Professor ON e.profID = Professor.profID
                WHERE Course.courseID = $courseId
                ORDER BY e.timePosted DESC";
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