<?php

class Db
{

    const DB_NAME = "bird_review";
    const DB_HOST = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";
    protected $db;
    protected $table;


    function getDB()
    {
        return new mysqli(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);
    }

    function insert(array $data)
    {
        $queryString = "insert into "
            . $this->table
            . " ( "
            . implode(',', array_keys($data))
            . " ) values('" . implode("','", array_values($data)) . "')";


        $db = $this->getDB();
        $db->query($queryString);
        $id = $db->insert_id;
        $db->close();
       return $id;

    }


    function update(array $data)
    {

        $query = "update " . $this->table ." set ";

        $query .= "reviewer_name = '".$data['reviewer_name']."', rating = ".$data['rating']
            .", review = '".$data['review'];
        $query .= "' where viewer_key = ".$data['viewer_key'];

        $db = $this->getDB();
        $result = $db->query( $query );
        $db->close();
        return $result;

    }

    function getAll()
    {

        $db = $this->getDB();
        $result = $db->query('select * from ' . $this->table);
        $db->close();

        return $result;

    }

    function totalResult()
    {
        $db = $this->getDB();
        $total = $db->query('select count(id) as cnt from birds');
        $db->close();
        return $total;

    }

    function getById($id)
    {
        $db = $this->getDB();
        $query = 'select * from ' . $this->table . ' where id=' . $id;
        $result = $db->query($query);
        $db->close();
        return $result;
    }

    function getBySortAsc()
    {
        $db = $this->getDB();
        $total = $db->query('select * from '.$this->table.' order by name asc');
        $db->close();
        return $total;
    }

    function getBySortDesc()
    {
        $db = $this->getDB();
        $total = $db->query('select * from '.$this->table.' order by name desc');
        $db->close();
        return $total;
    }

    function getRate() 
    {
        $db = $this->getDB();
        $total = $db->query('select * from '.$this->table.' order by name desc');
        $db->close();
        return $total;
    }
    
    function getByRateHigh()
    {
        $db = $this->getDB();
        $result = $db->query('select sum( rating ) as totalRating,b.* from bird_review as a join birds as b on a.birds_id = b.id group by birds_id order by totalRating desc');
        $db->close();
        return $result;   
    }

    function getByRateLow()
    {
        $db = $this->getDB();
        $result = $db->query('select sum( rating ) as totalRating,b.* from bird_review as a join birds as b on a.birds_id = b.id group by birds_id order by totalRating asc');
        $db->close();
        return $result;
    }

    function total_review( $id )
    {
        $db = $this->getDB();
        $result = $db->query('select count(*) as total_review from bird_review where birds_id = '.$id);
        $db->close();
        return $result;

    }

    function getRelated($table, $id, $column)
    {

        $db = $this->getDB();
        $result = $db->query('select * from ' . $table . ' where ' . $column . '= ' . $id);
        $db->close();
        return $result;
    }

    function delete( $key ) {

        $db = $this->getDB();
        $result = $db->query('delete from ' . $this->table . ' where viewer_key=' . $key);
        if(!$result) {
            return "Key doesn't match";
        }
        $db->close();
        return $result;
    }


}