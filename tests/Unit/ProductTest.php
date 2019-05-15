<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Builder\QueryBuilder;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSelectAll(){
        $sql = new QueryBuilder;
        $this->assertEquals('select * from products', $sql->select('products'));
    }
}
