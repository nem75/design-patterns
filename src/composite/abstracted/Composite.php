<?php
declare(strict_types=1);

namespace Jbr\DesignPatterns\Composite\Abstracted;

use Jbr\DesignPatterns\Composite\Abstracted\Component;
use InvalidArgumentException;

class Composite extends Component
{
    /** var Component[] */
    public $children = [];

    public function operation(): string
    {
        $result = [];

        foreach ($this->children as $child) {
            $result[] = $child->operation();
        }

        return implode(' ', $result);
    }

    public function add(Component $component): Component
    {
        if (in_array($component, $this->children)) {
            throw new InvalidArgumentException(
                'Component was already added', self::ERR_ALREADY_A_CHILD);
        }

        $this->children[] = $component;

        return $this;
    }

    public function getChild(int $index): ?Component
    {
        return $this->children[$index] ?: null;
    }

    public function remove(Component $component): Component
    {
        $index = array_search($component, $this->children);

        if ($index === false) {
            throw new InvalidArgumentException('Unknown child component', self::ERR_UNKNOWN_CHILD);
        }

        unset($this->children[$index]);

        return $this;
    }
}
