<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class PostCard extends Component
{
    public $userName;
    public $timePosted;
    public $title;
    public $excerpt;
    public $category;
    public $categoryColor;
    public $commentCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $userName='tj',
        $postId,
        $timePosted,
        $title,
        $excerpt,
        $category,
        $categoryColor,
        $commentCount = 0,
        
    ) {
        $this->userName = $userName;
        $this->timePosted = $timePosted;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->category = $category;
        $this->categoryColor = $categoryColor;
        $this->commentCount = $commentCount;
        $this->postId = $postId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-card');
    }
}