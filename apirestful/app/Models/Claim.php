<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    //use HasFactory;
    protected $table = 'u_yf_claims';
    public $timestamps = false;
    protected $primaryKey = 'claimsid';
    protected $fillable = ['claim_id', 'number', 'claim_number', 'provider', 'portfolio', 'type_of_job', 'date_of_loss', 'date_of_servie', 'pre_attorney_name', 'pre_litigation_status', 'onb_city', 'onb_zip',
    'onb_claim_number', 'onb_email', 'case'];
}
