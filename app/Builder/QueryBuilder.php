<?php
namespace App\Builder;

class QueryBuilder{
    
    public function select($table, $columns = [], $order = []){
        $columns = count($columns) == 0 ? '*' : implode(', ', $columns);
        $order = count($order) == 0 ? '' : ' order by '.implode(' ', $order);
        return "select $columns from $table$order";
    }
}