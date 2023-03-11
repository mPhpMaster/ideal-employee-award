<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperSupervisorCommittee
 */
class SupervisorCommittee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'employee_number', 'phone'];

    protected $searchableFields = ['*'];

    protected $table = 'supervisor_committees';

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
