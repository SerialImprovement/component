<?php
namespace SerialImprovement\Component;

use SerialImprovement\Core\Input;

abstract class Component
{
    /** @var Input */
    protected $props;

    /** @var Component[] */
    protected $children = [];

    /**
     * Component constructor.
     * @param $props
     * @param array $children
     */
    public function __construct(Input $props = null, array $children = [])
    {
        // dirty default props to new standard class
        if ($props === null){
            $props = new Input();
        }

        $this->props = $props;
        $this->children = $children;
    }

    protected function renderChildren()
    {
        $rendered = '';
        foreach ($this->children as $child) {
            $rendered .= $child->render();
        }

        return $rendered;
    }

    /**
     * should render the given component
     *
     * @return string
     */
    abstract public function render();

    /**
     * Allows you to use components directly inside strings
     * Simply calls the render method when php tries to convert to a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
