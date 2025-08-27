<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model {
    protected $fillable = ['project_id','title','description','artifact_link','outcome_type','quality_certification','commercialization_status'];
    public function project() { return $this->belongsTo(Project::class); }
}
