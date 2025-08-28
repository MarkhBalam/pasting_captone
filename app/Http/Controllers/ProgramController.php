<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $q         = request('q');          // free-text search
        $alignment = request('alignment');  // exact match filter

        $programs = Program::query()
            ->when($q, fn($qry) =>
                $qry->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('national_alignment', 'like', "%{$q}%");
                })
            )
            ->when($alignment, fn($qry) => $qry->where('national_alignment', $alignment))
            ->withCount('projects')              // efficient project counts
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // for the alignment dropdown
        $alignments = Program::select('national_alignment')->distinct()->pluck('national_alignment')->filter()->values();

        return view('programs.index', compact('programs', 'alignments'));
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'national_alignment'  => 'nullable|string|max:255',
            'focus_areas'         => 'nullable|array',
            'focus_areas.*'       => 'string|max:100',
            'phases'              => 'nullable|array',
            'phases.*'            => 'string|max:100',
        ]);

        Program::create($data);
        return redirect()->route('programs.index')->with('status','Program created');
    }

    public function show(Program $program)
    {
        $program->load('projects');
        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'national_alignment'  => 'nullable|string|max:255',
            'focus_areas'         => 'nullable|array',
            'focus_areas.*'       => 'string|max:100',
            'phases'              => 'nullable|array',
            'phases.*'            => 'string|max:100',
        ]);

        $program->update($data);
        return redirect()->route('programs.show', $program)->with('status','Program updated');
    }

    public function destroy(Program $program)
    {
        if ($program->projects()->exists()) {
            return back()->withErrors('Program has projects. Move or delete projects first.');
        }
        $program->delete();
        return redirect()->route('programs.index')->with('status','Program deleted');
    }
}
