<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'      => Post::count(),
            'services'   => Service::count(),
            'messages'   => Message::count(),
            'unread'     => Message::unread()->count(),
            'portfolio'  => Portfolio::count(),
            'testimonials' => Testimonial::count(),
        ];
        $recentMessages = Message::latest()->take(5)->get();
        $recentPosts    = Post::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentPosts'));
    }
}
