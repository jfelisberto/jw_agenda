<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'addresses';

	protected $casts = [
		'contact_id' => 'int',
		'user_id' => 'int'
	];

    protected $fillable = [
        'contact_id',
		'user_id',
        'type',
        'ibge',
        'siafi',
        'zipcode',
        'public_place',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country'
    ];

    protected $dates = ['deleted_at'];

    public function contact() {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
