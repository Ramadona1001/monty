<?php

namespace App\Http\Controllers;

use App\Services\FrontendContentService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private FrontendContentService $content) {}

    public function about(): View
    {
        return view('pages.about', [
            'activeNav' => 'about',
            'page' => $this->content->page('about'),
            'about' => $this->content->aboutSetting(),
            'statistics' => $this->content->statistics(),
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'activeNav' => 'services',
            'page' => $this->content->page('services'),
            'services' => $this->content->services(),
            'statistics' => $this->content->statistics(),
        ]);
    }

    public function gallery(): View
    {
        return view('pages.gallery', [
            'activeNav' => 'gallery',
            'page' => $this->content->page('gallery'),
            'galleryItems' => $this->content->galleryItems(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'activeNav' => 'contact',
            'page' => $this->content->page('contact'),
            'branches' => $this->content->contactBranches(),
            'socialLinks' => $this->content->socialLinks(),
        ]);
    }
}
