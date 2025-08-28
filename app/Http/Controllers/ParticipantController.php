<?php

namespace App\Http\Controllers;

use App\Models\{Participant, Project};
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $q         = request('q');
        $projectId = request('project_id');

        $participants = Participant::with('project')
            ->when($q, fn($qry) =>
                $qry->where(function ($w) use ($q) {
                    $w->where('full_name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('role_on_project', 'like', "%{$q}%")
                      ->orWhere('skill_role', 'like', "%{$q}%")
                      ->orWhere('institution', 'like', "%{$q}%")
                      ->orWhere('affiliation', 'like', "%{$q}%")
                      ->orWhere('specialization', 'like', "%{$q}%");
                })
            )
            ->when($projectId, fn($qry) => $qry->where('project_id', $projectId))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // for the filter dropdown
        $projects = Project::orderBy('title')->get();

        return view('participants.index', compact('participants', 'projects'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('participants.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'affiliation' => 'nullable|string|max:100',
            'specialization' => 'nullable|string|max:100',
            'cross_skill_trained' => 'sometimes|boolean',
            'institution' => 'nullable|string|max:100',
            'role_on_project' => 'nullable|string|max:100',
            'skill_role' => 'nullable|string|max:100',
        ]);

        // Ensure checkbox is coerced to boolean
        $data['cross_skill_trained'] = $request->boolean('cross_skill_trained');

        Participant::create($data);
        return redirect()->route('participants.index')->with('status', 'Participant added');
    }

    public function show(Participant $participant)
    {
        $participant->load('project');
        return view('participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        $projects = Project::orderBy('title')->get();
        return view('participants.edit', compact('participant', 'projects'));
    }

    public function update(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'affiliation' => 'nullable|string|max:100',
            'specialization' => 'nullable|string|max:100',
            'cross_skill_trained' => 'sometimes|boolean',
            'institution' => 'nullable|string|max:100',
            'role_on_project' => 'nullable|string|max:100',
            'skill_role' => 'nullable|string|max:100',
        ]);

        $data['cross_skill_trained'] = $request->boolean('cross_skill_trained');

        $participant->update($data);
        return redirect()->route('participants.show', $participant)->with('status', 'Participant updated');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('status', 'Participant deleted');
    }
}
