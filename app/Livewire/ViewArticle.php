<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Http;

class ViewArticle extends Component
{

    public $headline;
    public $story;

    public function mount(Article $article) {

        $response = Http::get('http://now.core.api.espn.com/v1/sports/news/' . $article->espn_id);
        
        $api = $response->json()['headlines'][0];
        
        $this->headline = $api['headline'] ?? $article->headline;
        $photos = $api['images'] ?? [];

        $story = $api['story'] ?? $article->story;

        foreach ($photos as $key => $photo) {
            $element = '<photo' . $key + 1 . '>';
            $story = str_replace($element, '<img src="'. $photo['url'] . '" height="'. $photo['height'] . '" width="'. $photo['width'] . '" alt="'. $photo['name'] . '">', $story);
        }

        // External links to new tabs
        $story = str_replace('<a href', '<a target="_blank" href', $story);

        $this->story = $story;
    }

    public function render()
    {



        return view('livewire.view-article');
    }
}
