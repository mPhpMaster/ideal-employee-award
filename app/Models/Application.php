<?php

namespace App\Models;

use App\Models\Model;

/**
 * @mixin IdeHelperApplication
 */
class Application extends Model implements \App\Interfaces\IHasPermissionGroup
{
    use \App\Traits\THasPermissionGroup;

    /** @type string */
    public const PERMISSION = 'Application`';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'direct_boss_id',
        'employee_id',
        'supervisor_committee_id',
        'technical_committee_id',
        'award_id',
        'rank',
        'direct_boss_points',
        'supervisor_committee_points',
        'technical_committee_points',
        'employee_points',
    ];

    /**
     * @var string[]
     */
    protected $searchableFields = [ '*'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function directBoss()
    {
        return $this->belongsTo(DirectBoss::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisorCommittee()
    {
        return $this->belongsTo(SupervisorCommittee::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function technicalCommittee()
    {
        return $this->belongsTo(TechnicalCommittee::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function award()
    {
        return $this->belongsTo(Award::class);
    }
}
