<?php

namespace Isswp101\Persimmon\Test;

use Isswp101\Persimmon\Test\Models\Product;
use Isswp101\Persimmon\QueryBuilder\QueryBuilder;

class HelpersTest
{
    public function testShould()
    {
        $p1 = new Product();
        $p1->id = 10;
        $p1->save();

        $p2 = new Product();
        $p2->id = 100;
        $p2->save();

        $p3 = new Product();
        $p3->id = 1000;
        $p3->save();

        $query = new QueryBuilder();
        $query->should('id', 10)->should('id', 1000)->build();

        $res = Product::search($query);

        $this->assertEquals(2, count($res));
    }
}