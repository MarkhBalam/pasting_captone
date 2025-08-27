<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {
    protected $fillable = ['name','description','national_alignment','focus_areas','phases'];
    protected $casts = ['focus_areas'=>'array','phases'=>'array'];
    public function projects() { return $this->hasMany(Project::class); }
}

