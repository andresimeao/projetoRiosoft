<?php
/*
 * Copyright 2015 Bruno de Oliveira Francisco <bruno@salluzweb.com.br>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace EasyFast\DataBase;

use PDOException;
use EasyFast\Exceptions\DBException;

/**
 * Class Select
 * Create and manage the SQL command for SELECT
 * @package EasyFast\DataBase
 */
trait Select
{
    /**
     * Columns
     * @var
     */
    private $col;

    /**
     * OrderBy
     * @var array
     */
    private $order = array();

    /**
     * GroupBy
     * @var array
     */
    private $group = array();

    /**
     * @var
     */
    private $limit_start;

    /**
     * @var
     */
    private $limit_end;

    /**
     * @var
     */
    private $join;

    /**
     * @var
     */
    private $sth;

    /**
     * Method join
     * Create a JOIN in the SQL
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param string $table Table name
     * @param string $column1 First column to compare
     * @param string $operator Comparison operator
     * @param string $column2 Second column to compare
     * @return Connection
     */
    public function join($table, $column1, $operator, $column2)
    {
        $this->join[] = "JOIN $table ON $column1 $operator $column2";
        return $this;
    }

    /**
     * Method getJoin
     * Get the created JOIN
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access private
     * @return string|null
     */
    private function getJoin()
    {
        if (isset($this->join)) {
            return implode(' ', array_values($this->join)) . "\n";
        }
        return null;
    }

    /**
     * Method leftJoin
     * Create a LEFT JOIN in the SQL
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param string $table Nome da tabela
     * @param string $column1 First column to compare
     * @param string $operator Comparison operator
     * @param string $column2 Second column to compare
     * @return Connection
     */
    public function leftJoin($table, $column1, $operator, $column2)
    {
        $this->join[] = "LEFT JOIN $table ON $column1 $operator $column2";
        return $this;
    }

    /**
     * Method limit
     * Add a LIMIT  parameter to the SQL script
     * @author Bruno Oliveira
     * @access public
     * @param int $limit
     * @return Connection
     */
    public function limit($limit_start, $limit_end = null)
    {
        $this->limit_start = $limit_start;
        $this->limit_end = $limit_end;
        return $this;
    }

    /**
     * Method getLimit
     * Get the created LIMIT
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access private
     * @return string|null
     */
    private function getLimit()
    {
        if (isset($this->limit_start) && is_null($this->limit_end)) {
            return "LIMIT $this->limit_start";
        }

        if(isset($this->limit_start) && !is_null($this->limit_end)) {
            return "LIMIT $this->limit_start,$this->limit_end";
        }

        return null;
    }

    /**
     * Method col
     * Add a colunm to the colunms for the SELECT
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param string|array $col A colunm from the database
     * @param string $as Alias column
     * @return Connection
     */
    public function col($col, $as = null)
    {
        if(!$this->col)
            $this->col = [];

        if(is_array($col)) {
            $this->col = array_merge($this->col, $col);
        } else {
            if (!is_null($as)) {
                $this->col[] = $col . ' AS ' . $as;
            } else {
                $this->col[] = $col;
            }
        }

        return $this;
    }

    /**
     * Method orderBy
     * Add a ORDER BY to the SQL script
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param string $column Colunm name
     * @param string $val
     * @return Connection
     */
    public function orderBy($column, $val)
    {
        $this->order[$column] = $val;
        return $this;
    }

    /**
     * @return $this
     */
    public function orderByRand()
    {
        $this->order = 'RAND()';
        return $this;
    }

    /**
     * Method getOrderBy
     * Get the created ORDER BY
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access private
     * @return string
     */
    private function getOrderBy()
    {
        $order = 'ORDER BY ';
        if (isset($this->order) && $this->order == 'RAND()') {
            $order .= $this->order . ', ';
        } elseif (is_array($this->order)) {
            foreach ($this->order as $key => $value) {
                $order .= $key . ' ' . strtoupper($value) . ', ';
            }
        }

        return substr($order, 0, strripos(trim($order), ',')) . "\n";
    }

    /**
     * GroupBy
     * Add a GROUP BY to the SQL script
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param string $column Colunm name
     * @return Connection
     */
    public function groupBy($column)
    {
        $this->group[] = $column;
        return $this;
    }

    /**
     * Get Group By
     * Get the created GROUP BY
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access private
     * @return string
     */
    private function getGroupBy()
    {
        $group = 'GROUP BY ';
        if (isset($this->group)) {
            foreach ($this->group as $value) {
                $group .= $value . ', ';
            }
        }

        return substr($group, 0, strripos(trim($group), ',')) . "\n";
    }


    /**
     * Method select
     * Create and execute SELECT using PDO
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @return mixed
     */
    public function select() {
        return $this->internalSelect();
    }

    /**
     * Method count
     * Create and execute SELECT using PDO
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @return mixed
     */
    public function count() {
        return $this->internalSelect(true);
    }

    /**
     * Method select
     * Create and execute SELECT using PDO
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access private
     * @return mixed
     */
    private function internalSelect($isCount = false)
    {
        try {
            $cols = is_array($this->col) ? implode(', ', array_values($this->col)) : '*';

            if($isCount)
                $cols = 'COUNT(1) as qtd';

            $this->setQuery("SELECT $cols FROM " .
                $this->getTable() .
                $this->getJoin() .
                $this->getWhere() .
                $this->getGroupBy() .
                $this->getOrderBy() .
                $this->getLimit());


            $this->sth = $this->prepare("SELECT $cols FROM " .
                $this->getTable() .
                $this->getJoin() .
                $this->getWhere() .
                $this->getGroupBy() .
                $this->getOrderBy() .
                $this->getLimit());

            if (is_array($this->getPrepareVals())) {
                foreach ($this->getPrepareVals() as $key => $val) {
                    $key += 1;
                    $this->sth->bindParam($key, $val);
                }
            }

            $this->sth->execute();

            if(!$isCount)
                $this->cleanWhere();

            return $isCount ? $this->sth->fetchAll()[0]->qtd : $this->sth->fetchAll();
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $this->getQuery());
        }
    }

    /**
     * Method rowCount
     * Returns the number of affected rows after SELECT
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @return string
     */
    public function rowCount()
    {
        return $this->sth->rowCount();
    }
}
