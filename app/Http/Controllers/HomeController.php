<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();
        $portfolios = Portfolio::active()->where('is_featured', true)->take(6)->get();
        $testimonials = Testimonial::active()->get();
        $posts = Post::published()->latest()->take(3)->get();
        $stats = [
            'projects' => Portfolio::where('is_active', true)->count() ?: 150,
            'clients'  => 80,
            'years'    => 8,
            'team'     => 25,
        ];
        return view('pages.home', compact('services','portfolios','testimonials','posts','stats'));
    }

    public function blog()
    {
        $posts = Post::published()->latest()->paginate(9);
        return view('pages.blog', compact('posts'));
    }

    public function blogPost($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $post->increment('views');
        $related = Post::published()->where('id', '!=', $post->id)->latest()->take(3)->get();
        return view('pages.blog-single', compact('post', 'related'));
    }

    public function services()
    {
        $services = Service::active()->get();
        return view('pages.services', compact('services'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::active()->get();
        $categories = Portfolio::active()->distinct()->pluck('category');
        return view('pages.portfolio', compact('portfolios', 'categories'));
    }

    public function contact()
    {
        $services = Service::active()->get();
        return view('pages.contact', compact('services'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|min:2|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|max:20',
            'subject' => 'nullable|max:200',
            'service' => 'nullable|max:100',
            'message' => 'required|min:10|max:2000',
        ]);

        $validated['ip_address'] = $request->ip();
        Message::create($validated);

        return response()->json([
            'success' => true,
            'message' => __('messages.contact_success')
        ]);
    }

    public function getStats()
    {
        return response()->json([
            'visitors' => rand(120, 180),
            'online'   => rand(5, 25),
            'projects' => Portfolio::count() ?: 150,
            'messages' => Message::where('created_at', '>=', now()->startOfDay())->count(),
        ]);
    }
}
