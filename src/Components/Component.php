<?php

declare(strict_types=1);

/*
 * This file is part of kodekeep/livewired.
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
        if ($this->hasMethodOrMacro($beforeMethod = 'before'.Str::studly($method))) {
            $this->$beforeMethod();
        }

        $result = parent::callMethod($method, $params);

        if ($this->hasMethodOrMacro($afterMethod = 'after'.Str::studly($method))) {
            $this->$afterMethod();
        }

        return $result;
    }

    public function render(): View
    {
        if (Str::startsWith(static::class, 'App\Http\Livewire')) {
            return parent::render();
        }

        return view('livewired::'.$this->getViewName());
    }

    protected function getViewName(): string
    {
        return str_replace('_', '-', Str::snake(class_basename(static::class)));
    }

    protected function hasMethodOrMacro(string $method): bool
    {
        if ($this->hasMacro($method)) {
            return true;
        }

        if (method_exists($this, $method)) {
            return true;
        }

        return false;
    }
}
