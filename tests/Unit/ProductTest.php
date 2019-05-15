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
        $sql = new QueryBuilder;
        $this->assertEquals('select * from products', $this->sql->select('products'));
    }

    public function testSelectColumns()
    {
        $sql = new QueryBuilder;
        $this->assertEquals('select id, name from products', $sql->select('products', ['id', 'name']));
    }
}
