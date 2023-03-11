<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperDirectBoss
 */
class DirectBoss extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'employee_number',
        'phone',
        'position_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'direct_bosses';

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
