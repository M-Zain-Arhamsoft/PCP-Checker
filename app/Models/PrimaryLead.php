<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryLead extends Model
{
    use HasFactory;
    protected $table = 'primary_leads';
    
    protected $fillable = [];
}
