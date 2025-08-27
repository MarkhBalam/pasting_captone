<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model {
    protected $fillable = ['facility_id','name','capabilities','description','inventory_code','usage_domain','support_phase'];
    public function facility() { return $this->belongsTo(Facility::class); }
}

