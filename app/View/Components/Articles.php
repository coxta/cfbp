<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class Articles extends Component
{

    public $stories;
    public $headlines;
    public $previews;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stories = Article::where('article_type', 'Story')->latest('published')->take(12)->get();
        $this->headlines = Article::where('article_type', 'HeadlineNews')->latest('published')->take(12)->get();
        $this->previews = Article::where('article_type', 'Preview')->latest('published')->take(12)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd('Whoa');
        return view('components.articles');
    }
}