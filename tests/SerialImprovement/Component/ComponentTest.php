<?php
namespace SerialImprovement\Component;

use SerialImprovement\Core\Input;

class GreetingComponent extends Component
{
    public function render()
    {
        return "<p>hello, {$this->props->get('name')}</p>";
    }
}

class ChildrenComponent extends Component
{
    public function render()
    {
        return "<p>{$this->renderChildren()}</p>";
    }
}

class ComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $component = new GreetingComponent(new Input(['name' => 'Jim']));
        $this->assertContains('hello, Jim', $component->render());
    }

    public function testRenderWithChildren()
    {
        $component = new ChildrenComponent(null, [
            new GreetingComponent(new Input(['name' => 'Bob'])),
            new GreetingComponent(new Input(['name' => 'Louise'])),
            new GreetingComponent(new Input(['name' => 'Pip'])),
        ]);

        $this->assertContains('Bob', $component->render());
        $this->assertContains('Louise', $component->render());
        $this->assertContains('Pip', $component->render());
    }
}
