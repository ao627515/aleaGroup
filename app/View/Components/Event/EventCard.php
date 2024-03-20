<?php

namespace App\View\Components\Event;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventCard extends Component
{
    public Event $event;
    /**
     * Create a new component instance.
     */
    public function __construct(
        Event $event
    )
    {
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event.event-card');
    }
}
