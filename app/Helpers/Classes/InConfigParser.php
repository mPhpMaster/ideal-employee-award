<?php

use App\Interfaces\IHasPermissionGroup;
use App\Interfaces\IRole;
use Carbon\Carbon;
use function Illuminate\Support\Facades\Hash;

/**
 * @noinspection PhpIllegalPsrClassPathInspection
 * @internal
 */
class InConfigParser
{
    public static function permissionOf(string|IHasPermissionGroup $name, string|IHasPermissionGroup $group = "system", string $guard_name = "web"): array
    {
        /** @var string $name */
        $name = $name instanceof IHasPermissionGroup ? $name::getPermissionGroupName() : (class_exists($name) ? class_basename($name) : $name);
        /** @var string $group */
        $group = $group instanceof IHasPermissionGroup ? $group::getPermissionGroupName() : (class_exists($group) ? class_basename($group) : $group);

        $guard_name = "web";
        // if( !stringContains($name, '.') ) {
        //     return static::permissionsOf($name, $group, $guard_name);
        // }
        $name = camel_case($name);

        return [ "name" => "{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ];
    }

    public static function permissionsOf(string|IHasPermissionGroup $name, string|IHasPermissionGroup $group = "system", string $guard_name = "web"): array
    {
        /** @var string $name */
        $name = $name instanceof IHasPermissionGroup ? $name::getPermissionGroupName() : (class_exists($name) ? class_basename($name) : $name);
        /** @var string $group */
        $group = $group instanceof IHasPermissionGroup ? $group::getPermissionGroupName() : (class_exists($group) ? class_basename($group) : $group);

        $guard_name = "web";
        // if( stringContains($name, '.') ) {
        //     return [ static::permissionOf($name, $group, $guard_name) ];
        // }

        $name = studly_case($name);

        return [
            // [ "name" => "index{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "viewAny{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "view{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "create{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "edit{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "delete{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "restore{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
            [ "name" => "forceDelete{$name}", "group" => "{$group}", "guard_name" => "{$guard_name}" ],
        ];
    }

    public static function roles(): array
    {
        return collect(array_wrap(config('permission.roles')))
            ->unique(fn($value) => array_values($value), true)
            ->all();
    }

    public static function roleOf(
        string $name, string $group = "system", string $guard_name = "web"
    ): array {
        $guard_name = "web";

        return compact('name', 'group', 'guard_name');
    }

    public static function userOf(
        array $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'role' => '',
            'phone' => '',
            'image' => '',
            'email_verified_at' => 0,
        ]
    ): array {
        $data['name'] ??= 'User';

        $data['email_verified_at'] = ($data['email_verified_at']??null) === 0 ? now() : Carbon::parse($data['email_verified_at']??null);

        $data['email'] ??= "{$data['name']}@app.com";

        $data['password'] ??= $data['email'] ?? '12345678';
        $data['password'] = Hash::needsRehash($data['password']) ? \Hash::make($data[ 'password' ]) : $data['password'];

        $data['role'] ??= IRole::EmployeeRole;

        $data['phone'] ??= '0500000000';
        $data['image'] ??= '';

        return $data;
    }
}
