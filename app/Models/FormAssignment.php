<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAssignment extends Model
{

    protected $table = 'form_assignments';

    protected $fillable = [
        'form_id',
        'user_id',
        'team_id',
        'created_by_id',
        'updated_by_id',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    
}
