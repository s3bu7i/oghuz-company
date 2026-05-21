<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|max:255',
            'short_description' => 'required|max:500',
            'description'       => 'nullable',
            'icon'              => 'nullable|max:100',
            'color'             => 'nullable|max:20',
            'order'             => 'integer',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);
        $data['slug']        = Str::slug($data['title']);
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Xidmət əlavə edildi!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'             => 'required|max:255',
            'short_description' => 'required|max:500',
            'description'       => 'nullable',
            'icon'              => 'nullable|max:100',
            'color'             => 'nullable|max:20',
            'order'             => 'integer',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);
        $data['slug']        = Str::slug($data['title']);
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Xidmət yeniləndi!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Xidmət silindi!');
    }
}
