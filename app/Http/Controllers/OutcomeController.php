<?php

namespace App\Http\Controllers;

use App\Models\{Outcome, Project};
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcomes = Outcome::with('project')->latest()->paginate(15);
        return view('outcomes.index', compact('outcomes'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact' => 'nullable|file',
            'outcome_type' => 'required|string|max:100',
            'quality_certification' => 'nullable|string|max:100',
            'commercialization_status' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('outcomes','public');
            $data['artifact_link'] = '/storage/'.$path;
        }

        $outcome = Outcome::create($data);
        return redirect()->route('projects.show', $outcome->project_id)->with('status','Outcome added');
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
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact' => 'nullable|file',
            'outcome_type' => 'required|string|max:100',
            'quality_certification' => 'nullable|string|max:100',
            'commercialization_status' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('outcomes','public');
            $data['artifact_link'] = '/storage/'.$path;
        }

        $outcome->update($data);
        return redirect()->route('outcomes.show', $outcome)->with('status','Outcome updated');
    }

    public function destroy(Outcome $outcome)
    {
        $projectId = $outcome->project_id;
        $outcome->delete();
        return redirect()->route('projects.show', $projectId)->with('status','Outcome deleted');
    }
}
