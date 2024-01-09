<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    use HasFactory;

    protected $table = 'zipcode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'UF',
        'CIDADE',
        'CEP_INICIO_1',
        'CEP_INICIO_2',
        'CEP_FIM_1',
        'CEP_FIM_2',
        'DEPARTAMENTO',
    ];

    public $timestamps = true;
}
