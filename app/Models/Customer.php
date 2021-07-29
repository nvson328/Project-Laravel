<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use Authenticatable;
    protected $table= 'tbl_customers';
    protected $fillable =[
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_password',
    ];
}
