<?php

declare(strict_types=1);

namespace App\Composite\Abstracted;

use App\Composite\Abstracted\Component;
use RuntimeException;

class Leaf extends Component
{
    /** var string */
    private $content;

    public function __construct($content)
    {
        $this->content = (string)$content;
    }

    public function operation(): string
    {
        return $this->content;
    }

    public function add(Component $component): Component
    {
        throw new RuntimeException('Adding children not supported', self::ERR_INVALID_OPERATION);
    }

    public function getChild(int $index): Component
    {
        throw new RuntimeException('Getting children not supported', self::ERR_INVALID_OPERATION);
    }

    public function remove(Component $component): Component
    {
        throw new RuntimeException('Removing children not supported', self::ERR_INVALID_OPERATION);
    }
}
