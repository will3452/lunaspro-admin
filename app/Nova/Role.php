<?php

namespace App\Nova;

use App\Models\Permission;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Coreproc\NovaPermissionsField\NovaPermissionsField;

class Role extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('name', '!=', ModelsRole::SUPERADMIN);
    }

    public static function availableForNavigation(Request $request)
    {
        return config('novax.role_enabled', false);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Role::class;

    public function authorizeToDelete(Request $request)
    {
        return false;
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make(__('Name'), 'name')
                ->readonly(function () {
                    /** @phpstan-ignore-next-line */
                    if ($this->name === \App\Models\Role::SUPERADMIN) {
                        return true;
                    }
                    return false;
                })
                ->rules(['required', 'string', 'max:125'])
                ->creationRules('unique:' . config('permission.table_names.roles'))
                ->updateRules('unique:' . config('permission.table_names.roles') . ',name,{{resourceId}}'),

            NovaPermissionsField::make(__('Permissions'), 'prepared_permissions')
                ->canSee(function () {
                    /** @phpstan-ignore-next-line */
                    if ($this->name === \App\Models\Role::SUPERADMIN) {
                        return false;
                    }
                    return true;
                })
                ->hideFromIndex()
                ->withGroups()
                ->options(Permission::all()->map(function ($permission, $key) {
                    return [
                        'group' => __(ucfirst($permission->group)),
                        'option' => $permission->name,
                        'label' => __($permission->name),
                    ];
                })->groupBy('group')->toArray()),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
