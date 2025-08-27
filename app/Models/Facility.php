<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model {
    protected $fillable = ['name','location','description','partner_organization','facility_type','capabilities'];
    protected $casts = ['capabilities'=>'array'];
    public function services() { return $this->hasMany(Service::class); }
    public function equipment() { return $this->hasMany(Equipment::class); }
    public function projects() { return $this->belongsToMany(Project::class, 'facility_project')->withTimestamps(); }
}
