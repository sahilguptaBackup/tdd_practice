<?php
namespace App\Builder;

class QueryBuilder{
    
    public function select($table, $columns = []){
        $columns = count($columns) == 0 ? '*' : implode(', ', $columns);
        return "select $columns from $table";
    }
}