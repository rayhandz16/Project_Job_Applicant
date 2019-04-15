<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'name',
        'email',
        'dateofbirth',
        'gender',
        'maritalstatus',
        'phone',
        'address',
        'cv',
        'status'
    ];
}
