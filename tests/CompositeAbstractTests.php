<?php

use PHPUnit\Framework\TestCase;
use Jbr\DesignPatterns\Composite\Abstracted as C;

class CompositeAbstractedTests extends TestCase
{
    public function testComponentOperation()
    {
        $c = new C\Component();
        $result = $c->operation();

        $this->assertSame($result, '42');
    }
}
