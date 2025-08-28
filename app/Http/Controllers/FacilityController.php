<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $q        = request('q');            // free-text
        $type     = request('type');         // exact match
        $partner  = request('partner');      // exact match
        $cap      = request('capability');   // JSON contains (array column)

        $facilities = Facility::query()
            ->when($q, fn($qry) =>
                $qry->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('location', 'like', "%{$q}%");
                })
            )
            ->when($type, fn($qry) => $qry->where('facility_type', $type))
            ->when($partner, fn($qry) => $qry->where('partner_organization', $partner))
            ->when($cap, fn($qry) => $qry->whereJsonContains('capabilities', $cap))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // For dropdown filters
        $types    = Facility::select('facility_type')->distinct()->pluck('facility_type')->filter()->values();
        $partners = Facility::select('partner_organization')->distinct()->pluck('partner_organization')->filter()->values();

        return view('facilities.index', compact('facilities','types','partners'));
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
