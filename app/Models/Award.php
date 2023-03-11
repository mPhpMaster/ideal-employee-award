<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperAward
 */
class Award extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['type', 'max_employee_points'];

    protected $searchableFields = ['*'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
