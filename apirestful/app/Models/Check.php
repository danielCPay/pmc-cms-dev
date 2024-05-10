<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_checks';
    public $timestamps = false;
    protected $primaryKey = 'checksid';
    protected $fillable = ['check_number', 'number', 'insured', 'claim_number', 'amount', 'scan_date', 'db_link', 'batch_number', 'attorney', 'case_id', 'provider', 'collection_created',
    'claimpay_check', 'outside_case_id', 'provider_by_user', 'insurance_company_by_user', 'insurance_company', 'portfolios', 'resolved', 'investor', 'investor_amount', 'provider_amount', 'flins', 'global_settlement_check',
    'flins_amount', 'warnings', 'claim_ids'];
}
