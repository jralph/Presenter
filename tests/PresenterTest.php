<?php

use Jralph\Presenter\AbstractPresenter;

class PresenterTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->testModel = (object) [
            'name' => 'Joe',
            'email' => 'example@example.com'
        ];

        $this->presenter = new FooTestPresenter($this->testModel);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_presenter_can_return_entity_attribute()
    {
        $this->assertEquals($this->testModel->name, $this->presenter->name);
    }

    public function test_presenter_has_model()
    {
        $this->assertSame($this->testModel, $this->presenter->getModel());
    }

    public function test_presenter_returns_expected_presented_attribute()
    {
        $this->assertEquals(strtolower($this->testModel->name), $this->presenter->lowercaseName);
    }

}

class FooTestPresenter extends AbstractPresenter {

    public function lowercaseName()
    {
        return strtolower($this->name);
    }

}