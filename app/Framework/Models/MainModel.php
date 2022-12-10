<?php 

    namespace SimpleWork\Framework\Models;

    use SimpleWork\Framework\Database\Db;

    class MainModel extends Db
    {

        private $table;

        public function table($table_name)
        {
            $this->table = $table_name;
            return $this->table;
        }

    }