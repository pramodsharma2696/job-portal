<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class ToastComponent extends Component
{
    public $showToast = false;
    public $message = '';
    public $type = 'success'; // can be 'success', 'error', 'warning', etc.

    protected $listeners = ['showToast' => 'showToastMessage'];

    public function showToastMessage($message = null, $type = 'success')
    {
        if (is_array($message)) {
            $this->message = $message['message'] ?? 'Operation successful!';
            $this->type = $message['type'] ?? 'success';
        } else {
            $this->message = $message ?? 'Operation successful!';
            $this->type = $type;
        }

        $this->showToast = true;
        
        // Auto-hide after 3 seconds
        $this->dispatch('hide-toast');
    }

    public function hideToast()
    {
        $this->showToast = false;
    }

    public function render()
    {
        return view('livewire.pages.toast-component');
    }
}