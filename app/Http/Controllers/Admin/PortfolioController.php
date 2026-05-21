<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order')->paginate(15);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'description'  => 'required',
            'client'       => 'nullable|max:100',
            'category'     => 'required|max:100',
            'technologies' => 'nullable|max:500',
            'url'          => 'nullable|url',
            'completed_at' => 'nullable|date',
            'order'        => 'integer',
            'is_active'    => 'boolean',
            'is_featured'  => 'boolean',
        ]);
        $data['slug']        = Str::slug($data['title']);
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        }

        Portfolio::create($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio əlavə edildi!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'description'  => 'required',
            'client'       => 'nullable|max:100',
            'category'     => 'required|max:100',
            'technologies' => 'nullable|max:500',
            'url'          => 'nullable|url',
            'completed_at' => 'nullable|date',
            'order'        => 'integer',
            'is_active'    => 'boolean',
            'is_featured'  => 'boolean',
        ]);
        $data['slug']        = Str::slug($data['title']);
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio yeniləndi!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return back()->with('success', 'Portfolio silindi!');
    }
}
