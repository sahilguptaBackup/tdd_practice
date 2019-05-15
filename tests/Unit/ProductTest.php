<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Builder\QueryBuilder;

class ProductTest extends TestCase
{

    public function setUp(): void {
        $this->sql = new QueryBuilder;
    }

    public function testExample()
    {
        $this->assertTrue(true);
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
}
