<?php namespace Jralph\Presenter;

use Jralph\Presenter\Exceptions\PresenterException;

trait PresentableTrait {

    /**
     * The current instance of the presenter.
     *
     * @var Jralph\Presenter\AbstractPresenter
     */
    protected $presenterInstance;

    /**
     * Create and/or return an instance of the presenter.
     *
     * @return Jralph\Presenter\AbstractPresenter
     */
    public function present()
    {
        if (!$this->presenter or !class_exists($this->presenter))
        {
            throw new PresenterException('Unable to find the requested presenter. Make sure the $presenter property is set.');
        }

        if (!$this->presenterInstance)
        {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }

}