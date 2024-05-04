<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
// use Laravel\Nova\Fields\Time;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Michielfb\Time\Time;
class Appointments extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Appointments::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make(__('ID'), 'id')->sortable(),
            Date::make('Date', 'date'),
            Time::make('Time', 'time')->sortable(),
            Text::make('Reason', 'reason')->sortable(),
            Text::make('Remarks', 'reason')->sortable(),
            Select::make('Type', 'type')
            ->options([
                'FollowUp' => 'Follow Up',
                'CheckUp' => 'Check Up',
            ]),
            Boolean::make('Reschedule', 'isReschedule'),
            Select::make('Status', 'status')
            ->options([
                'PENDING' => 'PENDING',
                'APPROVED' => 'APPROVED',
                'REJECTED' => 'REJECTED',
                'DECLINED' => 'DECLINED',
                'CANCELLED' => 'CANCELLED',
            ]),
            Date::make('Approved At', 'approved_at')->sortable(),
            Date::make('Declined At', 'declined_at')->sortable(),
            Date::make('Cancelled At', 'cancelled_at')->sortable(),
            BelongsTo::make('Profile', 'profile', Profile::class), 

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
