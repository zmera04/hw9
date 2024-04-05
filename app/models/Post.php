<?php
namespace app\models;

//using the database class namespace
use app\core\Database;

class Post
{
    //using the trait, bring in all of its methods
    use Database;

    public function getPostByID($id)
    {
        $query = 'select * from posts where id = :id';
        return $this->queryWithParams($query, ['id' => $id]);
    }

    public function getAllPosts()
    {
        $query = 'select * from posts';
        return $this->fetchAll($query);
    }

    public function savePost($data)
    {
        $query = 'insert into posts(title, description) values(:title, :description)';
        return $this->queryWithParams($query, ['title' => $data['title'],'description' => $data['description']]);
    }

    public function updatePost($data, $id)
    {
        $query = 'update posts set title = :title, description = :description where id = :id';
        return $this->queryWithParams($query, ['title' => $data['title'],'description' => $data['description'],'id' => $id]);
    }

    public function deletePost($id)
    {
        $query = 'delete from posts where id = :id';
        return $this->queryWithParams($query, ['id' => $id]);
    }
}