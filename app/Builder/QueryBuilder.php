<?php
namespace App\Builder;

class QueryBuilder{
    
    public function select($table, $option=""){
        if(is_numeric($option)){
            return "select * from products limit $option";
        }

        if(is_array($option)){
            if(count($option) == 2){
                if(is_numeric($option[0]) && is_numeric($option[1])){
                    return "select * from products limit ". $option[0] ." offset ". $option[1];
                }

                if($option[0] == 'count'){
                    return 'select *, count("'.$option[1].'") from products';
                }

                if($option[0] == 'max'){
                    return 'select max("'.$option[1].'") from products';
                }

                if($option[0] == 'group by'){
                    return 'select max("'.$option[1].'") from products group by '. $option[1];
                }

                if($option[0] == 'DISTINCT'){
                    return 'select DISTINCT "'.$option[1].'" from products';
                }
            }
        }
        return "select * from $table";
    }
}