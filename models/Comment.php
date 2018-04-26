<?php
namespace Blog\Models;

include_once("Model.php");
class Comment extends Model{

    function getComments($post_id){
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT c.id AS id, c.content, c.date, u.name AS username, u.id AS userId FROM comments AS c JOIN users u ON c.user_id=u.id WHERE c.post_id = :postID ORDER BY c.id DESC ';
        $cmt = $cx->prepare($sql);
        $cmt->execute([':postID'=>$post_id]);
        return $cmt->fetchAll();
    }
    function getComment($commentId){
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT c.id AS id, c.content, c.date, u.name AS username, u.id AS userId, c.post_id AS postid FROM comments AS c JOIN users u ON c.user_id=u.id WHERE c.id = :commentID ORDER BY c.id DESC ';
        $cmt = $cx->prepare($sql);
        $cmt->execute([':commentID'=>$commentId]);
        return $cmt->fetch();
    }
    function createComments($post_id, $auth_id, $content){
        $cx = $this->getConnectionToDb();
        $sql = 'INSERT INTO comments (post_id, user_id, content, date) VALUES (:postId, :userId, :content, NOW())';
        try{
            $cmt = $cx->prepare($sql);
            $cmt->execute([':postId'=>$post_id, ':userId'=>$auth_id, ':content'=>$content]);
            return $cx->lastInsertId();
        }Catch (PDOException $e ){
            return false;
        }
    }
    function updateComment($id, $content)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'UPDATE comments SET content = :content WHERE id = :id';
        $pst = $cx->prepare($sql);
        $pst->execute([':content'=>$content, ':id'=>$id]);
        return true;
    }
    function deleteComment($id){
        $cx = $this->getConnectionToDb();
        $sql = 'DELETE FROM comments WHERE id=:id';
        try{
            $cmt = $cx->prepare($sql);
            $cmt->execute([':id'=>$id]);
            return true;
        }Catch(PDOException $e){
            return false;
        }
    }
}