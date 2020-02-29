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

        if (property_exists($this, 'componentView')) {
            return view($this->componentView);
        }

        return view('livewired::components.'.$this->getViewName());
    }

    protected function getViewName(): string
    {
        $classPath = str_replace('App\\Http\\Livewire\\', null, static::class);
        $classPath = str_replace('KodeKeep\\Livewired\\Components\\', null, static::class);

        [$type, $name] = explode('\\', $classPath);

        $type = str_replace('_', '-', Str::snake($type));
        $name = str_replace('_', '-', Str::snake($name));

        return "{$type}.{$name}";
    }

    private function hasMethodOrMacro(string $method): bool
    {
        if (method_exists($this, $method)) {
            return true;
        }

        if ($this->hasMacro($method)) {
            return true;
        }

        return false;
    }
}
