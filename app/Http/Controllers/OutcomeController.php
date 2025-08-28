<?php

namespace App\Http\Controllers;

use App\Models\{Outcome, Project};
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        $q         = request('q');                        // free-text
        $projectId = request('project_id');               // filter by project
        $type      = request('outcome_type');             // filter by type
        $status    = request('commercialization_status'); // filter by status

        $outcomes = Outcome::with('project')
            ->when($q, fn($qry) =>
                $qry->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
                })
            )
            ->when($projectId, fn($qry) => $qry->where('project_id', $projectId))
            ->when($type, fn($qry) => $qry->where('outcome_type', $type))
            ->when($status, fn($qry) => $qry->where('commercialization_status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // for filter dropdowns
        $projects = Project::orderBy('title')->get();
        $types    = Outcome::select('outcome_type')->distinct()->pluck('outcome_type')->filter()->values();
        $statuses = Outcome::select('commercialization_status')->distinct()->pluck('commercialization_status')->filter()->values();

        return view('outcomes.index', compact('outcomes','projects','types','statuses'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'               => 'required|exists:projects,id',
            'title'                    => 'required|string|max:255',
            'description'              => 'nullable|string',
            'artifact'                 => 'nullable|file',
            'outcome_type'             => 'required|string|max:100',
            'quality_certification'    => 'nullable|string|max:100',
            'commercialization_status' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('outcomes', 'public');
            $data['artifact_link'] = '/storage/' . $path;
        }

        $outcome = Outcome::create($data);
        return redirect()->route('projects.show', $outcome->project_id)->with('status', 'Outcome added');
    }

    public function show(Outcome $outcome)
    {
        $outcome->load('project');
        return view('outcomes.show', compact('outcome'));
    }

    public function edit(Outcome $outcome)
    {
        $projects = Project::orderBy('title')->get();
        return view('outcomes.edit', compact('outcome','projects'));
    }

    public function update(Request $request, Outcome $outcome)
    {
        $data = $request->validate([
            'project_id'               => 'required|exists:projects,id',
            'title'                    => 'required|string|max:255',
            'description'              => 'nullable|string',
            'artifact'                 => 'nullable|file',
            'outcome_type'             => 'required|string|max:100',
            'quality_certification'    => 'nullable|string|max:100',
            'commercialization_status' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('outcomes', 'public');
            $data['artifact_link'] = '/storage/' . $path;
        }

        $outcome->update($data);
        return redirect()->route('outcomes.show', $outcome)->with('status', 'Outcome updated');
    }

    public function destroy(Outcome $outcome)
    {
        $projectId = $outcome->project_id;
        $outcome->delete();
        return redirect()->route('projects.show', $projectId)->with('status', 'Outcome deleted');
    }
}
