<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_cases';
    public $timestamps = false;
    protected $primaryKey = 'casesid';
    protected $fillable = ['casesid','case_id','claim_number'];
}
