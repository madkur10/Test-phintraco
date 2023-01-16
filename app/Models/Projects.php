<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'name',
        'description',
        'start_at',
        'finish_at',
        'created_by'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
