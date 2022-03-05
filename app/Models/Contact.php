<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'phone',
        'cnpj',
        'company'
    ];

    protected $dates = ['deleted_at'];

    public function address() {
        return $this->hasMany(Address::class, 'contact_id', 'id')->withTrashed();
    }

}
