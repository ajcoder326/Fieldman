<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = [
        'name',
        'description',
        'status',
        'for',
        'is_client_required',
        'created_by_id',
        'updated_by_id',
    ];

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function entries()
    {
        return $this->hasMany(FormEntry::class);
    }

    protected $casts = [
        'is_client_required' => 'boolean',
    ];


}
