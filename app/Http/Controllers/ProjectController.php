<?php

namespace App\Http\Controllers;

use App\Models\{Project, Program, Facility};
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['program','facilities'])->latest()->paginate(15);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $programs  = Program::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        return view('projects.create', compact('programs','facilities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'nature_of_project' => 'required|string|max:100',
            'description' => 'nullable|string',
            'innovation_focus' => 'nullable|string|max:100',
            'prototype_stage' => 'nullable|string|max:100',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
            'facility_ids' => 'nullable|array',
            'facility_ids.*' => 'exists:facilities,id',
        ]);

        $project = Project::create($data);
        if (!empty($data['facility_ids'])) {
            $project->facilities()->sync($data['facility_ids']);
        }

        return redirect()->route('projects.show', $project)->with('status','Project created');
    }

    public function show(Project $project)
    {
        $project->load(['program','facilities','participants','outcomes']);
        $allFacilities = Facility::orderBy('name')->get();
        return view('projects.show', compact('project','allFacilities'));
    }

    public function edit(Project $project)
    {
        $programs  = Program::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        return view('projects.edit', compact('project','programs','facilities'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'nature_of_project' => 'required|string|max:100',
            'description' => 'nullable|string',
            'innovation_focus' => 'nullable|string|max:100',
            'prototype_stage' => 'nullable|string|max:100',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
            'facility_ids' => 'nullable|array',
            'facility_ids.*' => 'exists:facilities,id',
        ]);

        $project->update($data);
        if ($request->has('facility_ids')) {
            $project->facilities()->sync($data['facility_ids'] ?? []);
        }

        return redirect()->route('projects.show', $project)->with('status','Project updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('status','Project deleted');
    }

    // linking methods for the pivot
    public function attachFacility(Project $project, Request $request)
    {
        $data = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
        ]);
        $project->facilities()->syncWithoutDetaching([$data['facility_id']]);
        return back()->with('status','Facility linked to project');
    }

    public function detachFacility(Project $project, Facility $facility)
    {
        $project->facilities()->detach($facility->id);
        return back()->with('status','Facility unlinked from project');
    }
}
