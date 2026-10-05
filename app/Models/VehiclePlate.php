<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePlate extends Model
{
    protected $table = 'vehicle_plates';
    
    protected $fillable = [
        'plate_number',
        'country_code',
        'vehicle_type',
        'color',
        'make',
        'model',
        'year',
        'owner_name',
        'owner_phone',
        'owner_email',
        'address',
        'status',
        'notes',
        'scanned_at',
        'scanned_by',
        'image_path'
    ];
    
    protected $casts = [
        'scanned_at' => 'datetime',
        'year' => 'integer'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    public function scopeStolen($query)
    {
        return $query->where('status', 'stolen');
    }
}