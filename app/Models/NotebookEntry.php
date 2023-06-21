<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotebookEntry extends Model
{
    use HasFactory;
    // todo replace guarded with fillable
    protected $guarded = [];
}
