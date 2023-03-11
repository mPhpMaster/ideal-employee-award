<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperTechnicalCommittee
 */
class TechnicalCommittee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'employee_number', 'phone'];

    protected $searchableFields = ['*'];

    protected $table = 'technical_committees';

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
