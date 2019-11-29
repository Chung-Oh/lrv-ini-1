<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Cria Model e Migration
 * Comando Artisan: "php artisan make:model Client -m"
 */
class Client extends Model
{
    public const TYPE_INDIVIDUAL = 'individual';
    public const TYPE_LEGAL      = 'legal';
    public const MARITAL_STATUS  = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];

    protected $fillable = [
        'name',
        'document_number',
        'email',
        'phone',
        'defaulter',
        'date_birth',
        'sex',
        'marital_status',
        'physical_desability'
    ];

    public static function getClientType($type)
    {
        return $type == Client::TYPE_LEGAL ? $type : Client::TYPE_INDIVIDUAL;
    }
}
