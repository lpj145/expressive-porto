<?php
namespace App\Containers\Consumers\Data\Model;

use App\Ship\Models\AbstractModel;

class Consumers extends AbstractModel
{
    protected $collection = 'consumers';
    protected $primaryKey = 'key';

    protected $fillable = [
        'key',
        'name',
        'active',
        'identifier'
    ];
}
