<?php namespace Jralph\Presenter;

abstract class AbstractPresenter {

    /**
     * An instance of the model being presented.
     *
     * @var mixed
     */
    protected $model;

    /**
     * Instantiate the presenter with an instance of the model.
     *
     * @param mixed $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Return the matching presenter method, or the model attribute.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key))
        {
            return $this->{$key}();
        }

        return $this->model->{$key};
    }

    /**
     * Return the instance of the model being used.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
    
    /**
     * Return the paramater on the model if the method does not exist.
     * 
     * @return mixed
     * /
    public function __call($method, $arguments)
    {
        return $this->model->{$method};   
    }
    }

}
