<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Illuminate\View\Component;

class BlogLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $setting = Setting::first();
        $pages_nav = Page::select('id', 'name', 'slug')->whereNavbar(true)->orderByDesc('id')->get();
        $pages_footer = Page::select('id', 'name', 'slug')->whereFooter(true)->orderByDesc('id')->get();

        return view('layouts.blog', compact('setting', 'pages_nav', 'pages_footer', ));
    }
}
