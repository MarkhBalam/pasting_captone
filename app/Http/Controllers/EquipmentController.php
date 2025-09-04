<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Facility $facility)
    {
        $equipment = $facility->equipment()->latest()->paginate(15);
        return view('equipment.index', compact('facility','equipment'));
    }

    public function create(Facility $facility)
    {
        return view('equipment.create', compact('facility'));
    }

    public function store(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capabilities' => 'nullable|string',
            'description' => 'nullable|string',
            'inventory_code' => 'nullable|string|max:100',
            'usage_domain' => 'nullable|string|max:100',
            'support_phase' => 'nullable|string|max:100',
        ]);

        $facility->equipment()->create($data);
        return redirect()->route('facilities.equipment.index', $facility)->with('status','Equipment added');
    }

    public function show(Equipment $equipment)
    {
        $equipment->load('facility');
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capabilities' => 'nullable|string',
            'description' => 'nullable|string',
            'inventory_code' => 'nullable|string|max:100',
            'usage_domain' => 'nullable|string|max:100',
            'support_phase' => 'nullable|string|max:100',
        ]);

        $equipment->update($data);
        return redirect()->route('equipment.show', $equipment)->with('status','Equipment updated');
    }

    public function destroy(Equipment $equipment)
    {
        $facility = $equipment->facility;
        $equipment->delete();
        return redirect()->route('facilities.show', $facility)->with('status','Equipment deleted');
    }

    public function all()
    {
        $q    = request('q');
        $sort = request('sort', 'created_at');
        $dir  = request('dir',  'desc');

        $allowed = ['name','created_at'];
        if (!in_array($sort, $allowed)) $sort = 'created_at';
        if (!in_array($dir,  ['asc','desc'])) $dir  = 'desc';

        $equipment = \App\Models\Equipment::with('facility')
            ->when($q, fn($qry) =>
                $qry->where(function ($w) use ($q) {
                    $w->where('name','like',"%{$q}%")
                      ->orWhere('description','like',"%{$q}%");
                })
            )
            ->orderBy($sort, $dir)
            ->paginate(15)
            ->withQueryString();

        return view('equipment.all', compact('equipment','sort','dir'));
    }
}
