<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Builder\QueryBuilder;

class ProductTest extends TestCase
{

    public function setUp(): void {
        $this->sql = new QueryBuilder;
    }

    public function testSelectAll()
    {
        $this->assertEquals('select * from products', $this->sql->select('products'));
    }

    public function testSelectColumns()
    {
        $this->assertEquals('select id, name from products', $this->sql->select('products', ['id', 'name']));
    }

    public function testOrderBy()
    {
        $this->assertEquals('select id, name from products order by id desc', $this->sql->select('products', ['id', 'name'], ['id', 'desc']));
    }

    public function testDoubleOrderBy()
    {
        $this->assertEquals('select * from products order by name asc, category asc', $this->sql->select('products', [['name', 'asc'],['category','asc']]));
    }

    public function testSelectOrderBy()
    {
        $this->assertEquals('SELECT id, name FROM products ORDER BY id DESC', $this->sql->select('products', ['id', 'name'], ['id', 'DESC']));
    }

    public function testLimit()
    {
        $this->assertEquals('select * from products limit 10', $this->sql->select('products', 10));
    }

    public function testLimitOffset()
    {
        $this->assertEquals('select * from products limit 6 offset 5', $this->sql->select('products', [6, 5]));
    }

    public function testCount()
    {
        $this->assertEquals('select *, count("id") from products', $this->sql->select('products', ['count','id']));
    }
    
    public function testMax()
    {
        $this->assertEquals('select max("cost") from products', $this->sql->select('products', ['max','cost']));
    }

    public function testGroupMax()
    {
        $this->assertEquals('select max("cost") from products group by cost', $this->sql->select('products', ['group by','cost']));
    }

    public function testDistinct()
    {
        $this->assertEquals('select DISTINCT "name" from products', $this->sql->select('products', ['DISTINCT','name']));
    }

    public function testDeleteEqual(){
        $this->assertEquals('DELETE FROM products WHERE name="abc"', $sql->sql->delete('products', ["name", "abc"]));
    }

    public function testDeletegreater(){
        $this->assertEquals('DELETE FROM products WHERE cost>500', $this->sql->delete('products', ["cost", ">", 100]));
    }

    public function testDelete(){
        $this->assertEquals('DELETE FROM products', $this->sql->delete('products'));
    }
}
