<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FacilityController extends Controller
{
    public function index()
    {
        $q       = request('q');          // free-text
        $type    = request('type');       // exact match
        $partner = request('partner');    // exact match
        $cap     = request('capability'); // JSON contains (array column)

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

    public function destroy(Facility $facility, Request $request)
    {
        $force = $request->boolean('force');

        // Pre-check dependents to avoid 500s and provide a helpful message
        $facility->loadCount(['services','equipment','projects']);

        if (!$force && ($facility->services_count > 0 || $facility->equipment_count > 0)) {
            $msg = "Facility has {$facility->services_count} service(s) and {$facility->equipment_count} equipment item(s). "
                 . "Delete/reassign them first, or use Force Delete.";
            return back()->with('error', $msg);
        }

        try {
            DB::transaction(function () use ($facility, $force) {
                // If forcing, remove children first so FK RESTRICT won't block the delete
                if ($force) {
                    $facility->services()->delete();
                    $facility->equipment()->delete();
                }

                // Always detach from projects (many-to-many)
                $facility->projects()->detach();

                // Finally delete the facility
                $facility->delete();
            });

            return redirect()->route('facilities.index')->with('status','Facility deleted');
        } catch (QueryException $e) {
            return back()->with('error', 'Cannot delete facility: there are related records linked to it.');
        }
    }
}
