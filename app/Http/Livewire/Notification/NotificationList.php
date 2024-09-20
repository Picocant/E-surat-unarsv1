<?php

namespace App\Http\Livewire\Notification;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationList extends Component
{
    public DatabaseNotificationCollection $notifications;
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->notifications = $this->user->notifications;
    }

    public function markAsRead($id)
    {
        $this->notifications->where('id', $id)->first()->markAsRead();
    }

    public function markAllAsRead()
    {
        $this->notifications->markAsRead();
    }

    public function delete($id)
    {
        $this->notifications->where('id', $id)->first()->delete();
        $this->mount();
    }

    public function deleteAll()
    {
        $this->user->notifications()->delete();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.notification.notification-list');
    }
}
