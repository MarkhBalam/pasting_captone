<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $q = Facility::query();
        if ($t = request('type')) $q->where('facility_type', $t);
        if ($p = request('partner')) $q->where('partner_organization', $p);
        if ($c = request('capability')) $q->whereJsonContains('capabilities', $c);

        $facilities = $q->latest()->paginate(15)->withQueryString();
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'partner_organization' => 'nullable|string|max:255',
            'facility_type' => 'nullable|string|max:100',
            'capabilities' => 'nullable|array',
            'capabilities.*' => 'string|max:100',
        ]);

        Facility::create($data);
        return redirect()->route('facilities.index')->with('status','Facility created');
    }

    public function show(Facility $facility)
    {
        $facility->load(['services','equipment','projects']);
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'partner_organization' => 'nullable|string|max:255',
            'facility_type' => 'nullable|string|max:100',
            'capabilities' => 'nullable|array',
            'capabilities.*' => 'string|max:100',
        ]);

        $facility->update($data);
        return redirect()->route('facilities.show', $facility)->with('status','Facility updated');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->projects()->exists()) {
            return back()->withErrors('Facility has projects. Unlink projects first.');
        }
        $facility->delete();
        return redirect()->route('facilities.index')->with('status','Facility deleted');
    }
}
