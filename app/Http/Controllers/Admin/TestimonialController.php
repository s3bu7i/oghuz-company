<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|max:100',
            'position'  => 'nullable|max:100',
            'company'   => 'nullable|max:100',
            'content'   => 'required',
            'rating'    => 'integer|min:1|max:5',
            'is_active' => 'boolean',
            'order'     => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Rəy əlavə edildi!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'      => 'required|max:100',
            'position'  => 'nullable|max:100',
            'company'   => 'nullable|max:100',
            'content'   => 'required',
            'rating'    => 'integer|min:1|max:5',
            'is_active' => 'boolean',
            'order'     => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Rəy yeniləndi!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Rəy silindi!');
    }
}
