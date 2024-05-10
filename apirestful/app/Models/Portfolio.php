<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_portfolios';
    public $timestamps = false;
    protected $primaryKey = 'portfoliosid';
    
    protected $fillable = ['portfoliosid','portfolio_id'];
}
