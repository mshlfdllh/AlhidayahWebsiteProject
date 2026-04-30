<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\Program;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPrograms     = Program::featured()->active()->orderBy('sort_order')->take(3)->get();
        $featuredAchievements = Achievement::featured()->orderByDesc('year')->take(6)->get();
        $galleryItems         = Gallery::featured()->orderBy('sort_order')->take(8)->get();

        $programCount     = Program::active()->count();
        $achievementCount = Achievement::count();

        return view('public.home.index', compact(
            'featuredPrograms',
            'featuredAchievements',
            'galleryItems',
            'programCount',
            'achievementCount'
        ));
    }
}