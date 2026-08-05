<?php

namespace App\Http\Controllers;

use App\Services\FrontendContentService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private FrontendContentService $content) {}

    public function index(): View
    {
        return view('pages.home', [
            'activeNav' => 'home',
            'page' => $this->content->page('home'),
            'heroSlides' => $this->content->heroSlides(),
            'about' => $this->content->aboutSetting(),
            'features' => $this->content->features(),
            'services' => $this->content->featuredServices(),
            'whyUs' => $this->content->whyUsSetting(),
            'workProcessSteps' => $this->content->workProcessSteps(),
        ]);
    }
}
