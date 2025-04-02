<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    /** @use HasFactory<\Database\Factories\RubricFactory> */
    use HasFactory, Filterable;

    public $timestamps = false;
    protected $table = 'rubrics';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
