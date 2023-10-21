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
        $this->headline = $article['headline'] ?? null;
        $this->description = $article['description'] ?? null;

        // Convert line breaks to <br> tags
        $this->story = str_replace("\n\n\r\n", "<br><br>", $article['story'] ?? null);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-summary.game-articles');
    }
}
