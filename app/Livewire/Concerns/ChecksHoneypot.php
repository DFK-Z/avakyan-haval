<?php

namespace App\Livewire\Concerns;

trait ChecksHoneypot
{
    public string $website = '';

    public string $honeypot = '';

    protected function passesHoneypot(): bool
    {
        return blank($this->website) && blank($this->honeypot);
    }
}
