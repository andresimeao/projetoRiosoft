<?php
/**
 * Created by PhpStorm.
 * User: hiago
 * Date: 24/12/2016
 * Time: 10:40
 */

namespace EasyFast\DataBase\NoSQL;

use EasyFast\App;
use \MongoDB\Driver\Manager;
use \MongoDB\Driver\WriteConcern;
use \MongoDB\Driver\BulkWrite;
use \MongoDB\Driver\Query;

class MongoDB
{
    /** @var  Manager $conn */
    private $conn;
    private $db;
    private $collection;
    private function getConn() {
        if(is_null($this->conn)) {
            $host = App::getAppConfig()['configGeneral']['mongoDB']['Host'];
            $port = App::getAppConfig()['configGeneral']['mongoDB']['Port'];
            $this->dbUse(App::getAppConfig()['configGeneral']['mongoDB']['DBName']);
            $this->conn = new Manager('mongodb://' . $host . ':' . $port);
        }
        return $this->conn;
    }

    private function executeBulkWriter($bulk, $collection = null) {
        if(is_null($collection)) {
            $collection = $this->collection;
        }

        return $this->getConn()->executeBulkWrite($this->db . '.' . $collection, $bulk, new WriteConcern(WriteConcern::MAJORITY, 100));
    }

    private function dbUse($db_name) {
        $this->db = $db_name;
    }

    public function collectionUse($collection) {
        $this->collection = $collection;
    }

    public function executeQuery($query) {
        return $this->getConn()->executeQuery($this->db, $query);
    }

    public function insert ($document, $collection = null) {
        $bulk = new BulkWrite();
        $bulk->insert($document);
        if(is_null($collection)) {
            $collection = $this->collection;
        }
        return $this->executeBulkWriter($bulk, $collection);
    }

    public function delete ($filter, $collection = null) {
        $bulk = new BulkWrite();
        $bulk->delete($filter);
        if(is_null($collection)) {
            $collection = $this->collection;
        }
        return $this->executeBulkWriter($bulk, $collection);
    }

    public function update ($filter, $newObjeto, $collection = null) {
        $bulk = new BulkWrite();
        $bulk->update($filter, array('$set' => $newObjeto), array('multi' => false, 'upsert' => false));
        if(is_null($collection)) {
            $collection = $this->collection;
        }
        return $this->executeBulkWriter($bulk, $collection);
    }

    public function search ($filter, $collection = null) {

        $query = new Query($filter);
        if(is_null($collection)) {
            $collection = $this->collection;
        }

        return $this->getConn()->executeQuery($this->db . '.' . $collection, $query)->toArray();
    }
}
