<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model {
    protected $fillable = ['project_id','full_name','email','affiliation','specialization','cross_skill_trained','institution','role_on_project','skill_role'];
    protected $casts = ['cross_skill_trained'=>'boolean'];
    public function project() { return $this->belongsTo(Project::class); }
}

