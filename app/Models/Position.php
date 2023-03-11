<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperPosition
 */
class Position extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function directBosses()
    {
        return $this->hasMany(DirectBoss::class);
    }
}
