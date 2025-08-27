<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Facility;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Facility $facility)
    {
        $services = $facility->services()->latest()->paginate(15);
        return view('services.index', compact('facility','services'));
    }

    public function create(Facility $facility)
    {
        return view('services.create', compact('facility'));
    }

    public function store(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'skill_type' => 'required|string|max:100',
        ]);

        $facility->services()->create($data);
        return redirect()->route('facilities.services.index', $facility)->with('status','Service created');
    }

    public function show(Service $service)
    {
        $service->load('facility');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'skill_type' => 'required|string|max:100',
        ]);

        $service->update($data);
        return redirect()->route('services.show', $service)->with('status','Service updated');
    }

    public function destroy(Service $service)
    {
        $facility = $service->facility;
        $service->delete();
        return redirect()->route('facilities.show', $facility)->with('status','Service deleted');
    }
}
