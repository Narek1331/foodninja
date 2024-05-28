<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Field;

class RadioImageField extends Field
{
    protected string $view = 'filament.components.radio-image';

    protected array $options = [];
    protected $defaultValue;

    public function options($options): static
    {
        $this->options = $options;
        return $this;
    }

    public function default($value): static
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

}
