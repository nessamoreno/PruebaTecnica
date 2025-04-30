<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'document_type',
        'document_number',
        'first_name',
        'last_name',
        'full_name',
        'address',
        'phone',
        'mobile',
        'email',
        'user',
    ];
}
