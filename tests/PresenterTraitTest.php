<?php

class PresenterTraitTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->testModel = new FooTestClass;
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_presentable_trait_returns_instance_of_presenter()
    {
        Mockery::mock('FooTestPresenter');
        $this->assertInstanceOf('FooTestPresenter', $this->testModel->present());
    }

    public function test_the_presenter_is_cached_for_later_use()
    {
        Mockery::mock('FooTestPresenter');

        $one = $this->testModel->present();
        $two = $this->testModel->present();

        $this->assertSame($one, $two);
    }

    /**
     * @expectedException Jralph\Presenter\Exceptions\PresenterException
     * @expectedExceptionMessage Unable to find the requested presenter. Make sure the $presenter property is set.
     */
    public function test_exception_thrown_if_presenter_is_missing()
    {
        $model = $this->testModel;
        $model->presenter = 'Invalid';

        $model->present();
    }

}

class FooTestClass {
    use Jralph\Presenter\PresentableTrait;

    public $presenter = 'FooTestPresenter';

    public $name = 'Joe';
    public $password = 'password';
    public $email = 'example@example.com';
}