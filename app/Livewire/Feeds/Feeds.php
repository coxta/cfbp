<?php

namespace App\Livewire\Feeds;

use Livewire\Component;

use App\Models\Feed;

class Feeds extends Component
{

    public Feed $feed;
    public $upserting = false;
    public $feeds;

    protected $rules = [
        'feed.name' => 'required|string|min:3|max:50',
        'feed.description' => 'required|string|min:3|max:150',
        'feed.job' => 'required|string|min:3|max:100',
        'feed.frequency' => 'required',
    ];

    public function mount()
    {
        $this->feed = new Feed;
    }

    public function render()
    {
        $this->feeds = Feed::all();
        return view('livewire.feeds.feeds');
        // ddd('Hello render');        
    }

    public function save()
    {
        $this->validate();
        $this->feed->save();
        $this->feed = new Feed;
        $this->upserting = false;
    }

}