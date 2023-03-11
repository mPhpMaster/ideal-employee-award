<?php

namespace App\Models;

use App\Interfaces\IRole;
use App\Models\Scopes\Searchable;
use App\Traits\THasScopeName;
use App\Traits\TModelTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Sereny\NovaPermissions\Traits\SupportsRole;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\RefreshesPermissionCache;

/**
 * @mixin IdeHelperRole
 */
class Role extends \Spatie\Permission\Models\Role implements IRole, \App\Interfaces\IHasPermissionGroup
{
    use HasFactory;
    use SoftDeletes;
    use TModelTranslation;
    use Searchable;
    use THasScopeName;
    use RefreshesPermissionCache;
    use SupportsRole;
    use \App\Traits\THasPermissionGroup;

    /** @type string */
    public const PERMISSION = 'Role';

    /**
     * @type string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'guard_name',
        'group',
    ];
    // protected $attributes = [
    //     'guard_name' => 'web',
    // ];

    /**
     * @var string[]
     */
    protected $searchableFields = [ '*' ];

    protected static function booting()
    {
        static::deleting(function(Role $model) {
            throw_if(!($user = currentUser()) || $user->hasRole($model->name), new \Illuminate\Validation\UnauthorizedException("Unauthorized.", 403));
        });
    }

    public function __construct(array $attributes = [])
    {
        $attributes[ 'guard_name' ] = $attributes[ 'guard_name' ] ?? config('auth.defaults.guard');

        parent::__construct($attributes);

        $this->guarded[] = $this->primaryKey;
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return trim(
            config('permission.table_names.roles', parent::getTable())
        );
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     * @static
     */
    public static function create(array $attributes = [])
    {
        $attributes[ 'guard_name' ] = $attributes[ 'guard_name' ] ?? 'web';
        $params = [ 'name' => $attributes[ 'name' ], 'guard_name' => $attributes[ 'guard_name' ] ];
        if( PermissionRegistrar::$teams ) {
            if( array_key_exists(PermissionRegistrar::$teamsKey, $attributes) ) {
                $params[ PermissionRegistrar::$teamsKey ] = $attributes[ PermissionRegistrar::$teamsKey ];
            } else {
                $attributes[ PermissionRegistrar::$teamsKey ] = getPermissionsTeamId();
            }
        }
        if( static::findByParam($params) ) {
            throw RoleAlreadyExists::create($attributes[ 'name' ], $attributes[ 'guard_name' ]);
        }

        return static::query()->create($attributes);
    }

    /**
     * @param \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Role $roleOrPermission
     *
     * @throws \Spatie\Permission\Exceptions\GuardDoesNotMatch
     */
    protected function ensureModelSharesGuard($roleOrPermission)
    {

    }

    /**
     * @return \Spatie\Permission\Contracts\Role|\App\Interfaces\IRole
     */
    public static function forSuperAdmin(): \Spatie\Permission\Contracts\Role|IRole|null
    {
        return static::findByName(IRole::SuperAdminRole);
    }

    /**
     * @return \Spatie\Permission\Contracts\Role|\App\Interfaces\IRole
     */
    public static function forAdmin(): \Spatie\Permission\Contracts\Role|IRole|null
    {
        return static::findByName(IRole::AdminRole);
    }

    public static function forEmployee(): \Spatie\Permission\Contracts\Role|IRole|null
    {
        return static::findByName(IRole::EmployeeRole);
    }

    public static function forForeman(): \Spatie\Permission\Contracts\Role|IRole|null
    {
        return static::findByName(IRole::ForemanRole);
    }

    public static function forSupervisor(): \Spatie\Permission\Contracts\Role|IRole|null
    {
        return static::findByName(IRole::SupervisorRole);
    }

    public function scopeGetAllRoles(Builder $builder, bool $only_names = true, ...$except): Collection
    {
        return toCollect(\InConfigParser::roles())
            ->when($only_names, fn($c) => $c->map(fn($a) => data_get(array_wrap($a), 'name')))
            ->reject(fn($a) => $a && in_array($a, array_filter($except)));
    }
}
