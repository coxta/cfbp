<?php

namespace App\Livewire\Feeds;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Feed;

class ShowFeed extends Component
{

    use WithPagination;

    public Feed $feed;
    public $editing = false;

    protected $rules = [
        'feed.name' => 'required|string|min:3|max:50',
        'feed.description' => 'required|string|min:3|max:150',
        'feed.job' => 'required|string|min:3|max:100',
        'feed.frequency' => 'required',
    ];

    public function mount(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function render()
    {
        return view('livewire.feeds.show-feed', [
            'logs' => $this->feed->logs()->latest()->paginate(7)
        ]);
    }

    public function save()
    {
        $this->validate();
        $this->feed->save();
        $this->editing = false;
    }

    public function run()
    {
        call_user_func( array( $this->feed->job, 'dispatch' ) );
    }
}