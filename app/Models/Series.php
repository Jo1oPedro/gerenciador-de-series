<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    protected $with = ['seasons'];

    public function seasons() 
    {
        /* it is not necessary to define the second parameter on this 
            relationship because it takes the name of the class => Series
            and put in snake case with id, so it becomes series_id
        */
        return $this->hasMany(Season::class/*, 'series_id'*/);
    }

    protected static function booted() 
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}
