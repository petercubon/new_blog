<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Measurement;

use Nette\Application\UI\Control as NetteControl;
use Nette\Application\UI\Form;

class Control extends NetteControl
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess,
        private ?int $measurementId,
        private ?int $deviceId,
        private string $deviceName,
    )
    {
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->deviceName = $this->deviceName;
        $this->template->render(__DIR__.'/default.latte');
    }

    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create($this->measurementId, $this->deviceId);

        $form->onSuccess[] = $this->onSuccess;

        return $form;
    }
}