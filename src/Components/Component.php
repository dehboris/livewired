<?php

declare(strict_types=1);

/*
 * This file is part of Livewired.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Livewired\Components;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component as Livewire;

class Component extends Livewire
{
    public function callMethod($method, $params = [])
    {
        if (method_exists($this, $beforeMethod = 'before'.Str::studly($method))) {
            $this->$beforeMethod();
        }

        $result = parent::callMethod($method, $params);

        if (method_exists($this, $afterMethod = 'after'.Str::studly($method))) {
            $this->$afterMethod();
        }

        return $result;
    }

    public function render(): View
    {
        if (property_exists($this, 'componentView')) {
            return view($this->componentView);
        }

        return view('livewired::components.'.$this->getViewName());
    }

    protected function getViewName(): string
    {
        [$type, $name] = explode('\\', str_replace('KodeKeep\\Livewired\\Components\\', null, static::class));

        $type = str_replace('_', '-', Str::snake($type));
        $name = str_replace('_', '-', Str::snake($name));

        return "{$type}.{$name}";
    }
}
