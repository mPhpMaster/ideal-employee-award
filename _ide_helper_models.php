<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Abstracts{
/**
 * App\Models\Abstracts\UserAbstract
 *
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $image_url
 * @property string|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-write mixed $image
 * @property-write mixed $password
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract byRole(?string ...$role)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAbstract role($roles, $guard = null)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperUserAbstract {}
}

namespace App\Models{
/**
 * App\Models\Application
 *
 * @property int $id
 * @property int $direct_boss_id
 * @property int $employee_id
 * @property int $supervisor_committee_id
 * @property int $technical_committee_id
 * @property int $award_id
 * @property int|null $rank
 * @property int|null $direct_boss_points
 * @property int|null $supervisor_committee_points
 * @property int|null $technical_committee_points
 * @property int|null $employee_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Award $award
 * @property-read \App\Models\DirectBoss $directBoss
 * @property-read \App\Models\Employee $employee
 * @property-read \App\Models\SupervisorCommittee $supervisorCommittee
 * @property-read \App\Models\TechnicalCommittee $technicalCommittee
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereAwardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereDirectBossId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereDirectBossPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereEmployeePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereSupervisorCommitteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereSupervisorCommitteePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereTechnicalCommitteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereTechnicalCommitteePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperApplication {}
}

namespace App\Models{
/**
 * App\Models\Award
 *
 * @property int $id
 * @property string $type
 * @property int|null $max_employee_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @method static \Database\Factories\AwardFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Award newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Award newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Award query()
 * @method static \Illuminate\Database\Eloquent\Builder|Award search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Award searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereMaxEmployeePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperAward {}
}

namespace App\Models{
/**
 * App\Models\DirectBoss
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $employee_number
 * @property string|null $phone
 * @property int $position_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read \App\Models\Position $position
 * @method static \Database\Factories\DirectBossFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss query()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereEmployeeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectBoss whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperDirectBoss {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $employee_number
 * @property int $position_id
 * @property int $direct_boss_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Application|null $application
 * @property-read \App\Models\DirectBoss $directBoss
 * @property-read \App\Models\Position $position
 * @method static \Database\Factories\EmployeeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDirectBossId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmployeeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperEmployee {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string|null $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission byGroup($group)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission byName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutGroup(...$group)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutName(...$name)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperPermission {}
}

namespace App\Models{
/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DirectBoss> $directBosses
 * @property-read int|null $direct_bosses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Database\Factories\PositionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Position searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperPosition {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string|null $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role byGroup($group)
 * @method static \Illuminate\Database\Eloquent\Builder|Role byName($name)
 * @method static \Database\Factories\RoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Role getAllRoles(bool $only_names = true, ...$except)
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Role searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutGroup(...$group)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutName(...$name)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * App\Models\SupervisorCommittee
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $employee_number
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @method static \Database\Factories\SupervisorCommitteeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereEmployeeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupervisorCommittee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperSupervisorCommittee {}
}

namespace App\Models{
/**
 * App\Models\TechnicalCommittee
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $employee_number
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @method static \Database\Factories\TechnicalCommitteeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee query()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereEmployeeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalCommittee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperTechnicalCommittee {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property string $phone
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null $image_url
 * @property string|null $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User byEmail($email)
 * @method static \Illuminate\Database\Eloquent\Builder|User byRole(?string ...$role)
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|User searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class IdeHelperUser {}
}

