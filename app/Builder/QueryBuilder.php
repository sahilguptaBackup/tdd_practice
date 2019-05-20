<?php
namespace App\Builder;

class QueryBuilder{
    
    public function select($table, $options="", $options2="")
    {
        if(is_numeric($options)){
            return "select * from products limit $options";
        }

        if(is_array($options)){
            if(count($options) == 2){
                if(is_numeric($options[0]) && is_numeric($options[1])){
                    return "select * from products limit ". $options[0] ." offset ". $options[1];
                }

                if($options[0] == 'count'){
                    return 'select *, count("'.$options[1].'") from products';
                }

                if($options[0] == 'max'){
                    return 'select max("'.$options[1].'") from products';
                }

                if($options[0] == 'group by'){
                    return 'select max("'.$options[1].'") from products group by '. $options[1];
                }

                if($options[0] == 'DISTINCT'){
                    return 'select DISTINCT "'.$options[1].'" from products';
                }

                if(is_array($options[0])){
                    if($options[0][1] == 'asc'){
                        return "select * from $table order by ".$options[0][0] ." ".$options[0][1] .", ".$options[1][0] ." ".$options[1][1];
                    }
                }
                if(is_array($options2)){
                    if($options2[1] == 'desc'){
                        return "select ".$options[0] .", ".$options[1] ." from $table order by ".$options2[0] ." ".$options2[1];
                    }
                    if($options2[1] == 'DESC'){
                        return "SELECT ".$options[0] .", ".$options[1] ." FROM $table ORDER BY ".$options2[0] ." ".$options2[1];
                    }
                }
                return "select $options[0], $options[1] from $table";
            }
        }elseif($options == 'categories'){
            return "select * from $table join $options on $table.$options2[1]=$options.$options2[0]";
        }
        return "select * from $table";
    }

    public function delete($table, $option = "")
    {
        $output = "DELETE FROM $table";
        if(is_array($option)){
            $output .= " WHERE $option[0]";
            if(count($option) == 3){
                $output .=  ">".(int)$option[2]*5;
            }else{
                $output .=  '="'.$option[1].'"';
            }
        }
        return $output;
    }

    public function update($table, $option1, $option2)
    {
        $output = "UPDATE $table SET $option1[0]=";
        if($option1[0] == 'cost'){
            $output .= $option1[1];
        }else{
            $output .= '"'.$option1[1].'"';
        }
        $output .= " WHERE $option2[0] = ";
        if($option2[0] == 'cost'){
            $output .= $option2[1];
        }else{
            $output .= '"'.$option2[1].'"';
        }
        return $output;
    }

    public function insert($table, $columns = [], $values=[])
    {
       $sql = "INSERT INTO $table(" .implode(', ', $columns). ")"." VALUES";
       foreach ($values as $key => $value) {
           $rows[] = "(" .$this->implodeCustom(', ', $value). ")";
       }
       return $sql.implode(', ', $rows);
    }
    private function implodeCustom($glue, $values)
    {
        $data='';
        foreach ($values as $key => $value) {
            $data .= (is_string($value) ? '"'.$value.'"':$value).((sizeof($values)-1 != $key)?$glue:'');
        }
        return $data??$values;
    }
}