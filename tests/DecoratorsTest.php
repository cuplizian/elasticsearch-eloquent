<?php

namespace Isswp101\Persimmon\Test;

use Isswp101\Persimmon\QueryBuilder\Filters\Decorator\HasParentDecorator;
use Isswp101\Persimmon\QueryBuilder\Filters\IdsFilter;
use Isswp101\Persimmon\QueryBuilder\QueryBuilder;
use Isswp101\Persimmon\Test\Models\PurchaseOrder;
use Isswp101\Persimmon\Test\Models\PurchaseOrderLine;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class DecoratorsTest extends BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $hash = time() . rand(1, 1000);
        PurchaseOrder::$index = 'travis_ci_test_parent_child_rel_' . $hash;
        PurchaseOrderLine::$index = 'travis_ci_test_parent_child_rel_' . $hash;
    }

    public function testPrepareIndex()
    {
        $index = PurchaseOrderLine::getIndex();

        try {
            $this->es->indices()->delete(['index' => $index]);
        } catch (Missing404Exception $e) {
        }

        $this->sleep(3);

        $settings = file_get_contents(__DIR__ . '/index.json');
        $this->es->indices()->create(['index' => $index, 'body' => $settings]);
    }

    public function testHasParentDecorator()
    {
        $po = new PurchaseOrder();
        $po->id = 1;
        $line = new PurchaseOrderLine();
        $line->id = 2;

        $po->save();
        $line->po()->associate($po);
        $line->save();

        $parent = $line->getParentType();
        $query = new QueryBuilder();
        $filter = new IdsFilter([1]);
        $decoratedFilter = new HasParentDecorator($filter, $parent);
        $query->filter($decoratedFilter);
        
        $res = PurchaseOrderLine::search($query);

        $this->assertEquals(1, count($res));
        $this->assertEquals(1, $res[0]->id);
    }

    public function testTearDown()
    {
        $this->deleteIndex(PurchaseOrderLine::$index);
    }
}