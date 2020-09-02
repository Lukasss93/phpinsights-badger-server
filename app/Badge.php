<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'repo',
        'code',
        'complexity',
        'architecture',
        'style',
        'security_issues'
    ];
}
