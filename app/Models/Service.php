<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['facility_id','name','description','category','skill_type'];
    public function facility() { return $this->belongsTo(Facility::class); }
}

