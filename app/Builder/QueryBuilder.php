<?php
namespace App\Builder;

class QueryBuilder{
    
    public function select($table){
        return 'select * from '. $table;
    }
}