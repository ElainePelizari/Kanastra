<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'debtId',
        'name',
        'cpf',
        'email',
        'debtAmount',
        'status_ticket',
        'paid'
    ];

    protected $dates = [
        'debtDueDate',
        'created_at',
        'updated_at',
    ];
}
