<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommentCard extends Component
{
    public $name, $body, $time,$isAuth,$commentId,$isPostAuth;
    public function __construct($name, $body, $time,$isAuth,$commentId,$isPostAuth)
    {
        $this->name = $name;
        $this->body = $body;
        $this->time = $time;
        $this->isAuth = $isAuth;
        $this->commentId = $commentId;
        $this->isPostAuth = $isPostAuth;
    
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment-card');
    }
}
