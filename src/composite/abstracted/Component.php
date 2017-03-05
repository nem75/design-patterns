<?php
declare(strict_types=1);

namespace Jbr\DesignPatterns\Composite\Abstracted;


abstract class Component
{
    const ERR_UNKNOWN_CHILD = 1;
    const ERR_INVALID_OPERATION = 2;
    const ERR_ALREADY_A_CHILD = 3;

    /** var bool */
    private $commonAttribute;

    abstract public function operation(): string;

    abstract public function add(Component $component): Component;

    abstract public function getChild(int $index): ?Component;

    abstract public function remove(Component $component): Component;

    public function setCommonAttribute(bool $v): Component
    {
        $this->commonAttribute = $v;

        return $this;
    }

    public function getCommonAttribute(): ?bool
    {
        return $this->commonAttribute;
    }
}
