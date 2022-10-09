<?php

namespace App\components\Post\Grid;

use App\components\Post\Grid\ControlFactory;

trait ControlTrait
{
    private ControlFactory $postGridControlFactory; // inject z Post/Grid/ControlFactory

    public function __construct(ControlFactory $postGridControlFactory)
    {
        $this->postGridControlFactory = $postGridControlFactory;
    }

    //    injektovanie znamena nacitanie dat z Dependency Injection Containeru je mozne vytvorit 3 sposobmi a to:
    // cez "construct()" !! optimalny sposob na inject z DI Containeru
    // cez "injectMethod()"
    // cez inject anotaciu s vyuzitim public property, !! zly dizajnovy navrh !!

    public function injectPostGridControlFactory(ControlFactory $controlFactory) // inject ControlFactory
    {
        $this->postGridControlFactory = $controlFactory;
    }

    public function createComponentPostGrid(): Control
    {

        return $this->postGridControlFactory->create();
    }
}