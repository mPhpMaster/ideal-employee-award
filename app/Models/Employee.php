<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperEmployee
 */
class Employee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'employee_number',
        'position_id',
        'direct_boss_id',
    ];

    protected $searchableFields = ['*'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function directBoss()
    {
        return $this->belongsTo(DirectBoss::class);
    }

    public function application()
    {
        return $this->hasOne(Application::class);
    }
}
