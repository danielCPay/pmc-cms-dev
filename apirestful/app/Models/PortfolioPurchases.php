<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_portfoliopurchases';
    public $timestamps = false;
    protected $primaryKey = 'portfoliopurchasesid';

    protected $fillable = ['portfoliopurchasesid', 'portfolio'];
}
