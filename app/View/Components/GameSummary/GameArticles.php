<?php

namespace App\View\Components\GameSummary;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameArticles extends Component
{

    public $headline, $description, $story, $stories;
    /**
     * Create a new component instance.
     */
    public function __construct($article, $stories)
    {
        $this->stories = $stories;
        $this->headline = $article['headline'];
        $this->description = $article['description'];

        // Convert line breaks to <br> tags
        $this->story = str_replace("\n\n\r\n", "<br><br>", $article['story']);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-summary.game-articles');
    }
}
