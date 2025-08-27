<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['program_id','title','nature_of_project','description','innovation_focus','prototype_stage','testing_requirements','commercialization_plan'];
    public function program() { return $this->belongsTo(Program::class); }
    public function facilities() { return $this->belongsToMany(Facility::class, 'facility_project')->withTimestamps(); }
    public function participants() { return $this->hasMany(Participant::class); }
    public function outcomes() { return $this->hasMany(Outcome::class); }
}

