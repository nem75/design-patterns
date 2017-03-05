<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Jbr\DesignPatterns\Composite\Abstracted as C;

class CompositeAbstractedTests extends TestCase
{
    public function testComponentCommonAttribute()
    {
        $c = new C\Composite();

        $this->assertNull($c->getCommonAttribute());
        $this->assertSame($c, $c->setCommonAttribute(true));
        $this->assertTrue($c->getCommonAttribute());
    }

    public function testCompositeAdd()
    {
        $child = new C\Composite();
        $parent = new C\Composite();

        $this->assertSame($parent, $parent->add($child));
    }

    public function testCompositeGetChild()
    {
        $child = new C\Composite();
        $parent = new C\Composite();
        $parent->add($child);

        $this->assertSame($parent->getChild(0), $child);
    }

    public function testCompositeGetUnknownChild()
    {
        $c = new C\Composite();

        $this->assertNull($c->getChild(42));
    }

    public function testCompositeAddingSameChildImpossible()
    {
        $child = new C\Composite();
        $parent = new C\Composite();
        $parent->add($child);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(C\Component::ERR_ALREADY_A_CHILD);
        $parent->add($child);
    }

    public function testCompositeRemove()
    {
        $child = new C\Composite();
        $parent = new C\Composite();
        $parent->add($child);

        $this->assertSame($parent, $parent->remove($child));
        $this->assertNull($parent->getChild(0));
    }

    public function testCompositeRemoveUnknownChild()
    {
        $c = new C\Composite();
        $notTheChild = new C\Composite();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(C\Component::ERR_UNKNOWN_CHILD);
        $c->remove($notTheChild);
    }

    public function testLeafOperation()
    {
        $leaf = new C\Leaf('6 times 7');

        $this->assertSame('6 times 7', $leaf->operation());
    }

    public function testLeafAdd()
    {
        $leaf = new C\Leaf('x');
        $c = new C\Composite();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(C\Component::ERR_INVALID_OPERATION);
        $leaf->add($c);
    }

    public function testLeafRemove()
    {
        $leaf = new C\Leaf('x');
        $c = new C\Composite();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionCode(C\Component::ERR_INVALID_OPERATION);
        $leaf->remove($c);
    }

    public function testCompositeOperation()
    {
        $c = new C\Composite();

        $c->add((new C\Leaf('6 times 7')))
            ->add((new C\Leaf('equals')))
            ->add((new C\Leaf('42')));

        $this->assertSame('6 times 7 equals 42', $c->operation());
    }
}
