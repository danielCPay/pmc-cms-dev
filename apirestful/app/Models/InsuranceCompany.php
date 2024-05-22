<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_insurancecompanies';
    public $timestamps = false;
    protected $primaryKey = 'insurancecompaniesid';
    protected $fillable = ['insurancecompaniesid','insurance_company_name','number'];
}
