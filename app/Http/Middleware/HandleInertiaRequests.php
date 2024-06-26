<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'warning' => fn () => $request->session()->get('warning'),
                'danger' => fn () => $request->session()->get('danger')
            ],

            'permission' => [
                'users' => function() use ($request){
                    $user = $request->user();
                    if($user){
                        return [
                            'viewAny' => $user->can('viewAny',User::class),
                            'create' => $user->can('create',User::class),
                            'unreadNotifications' => $request->user()->unreadNotifications()->count(),
                        ];
                    }
                }
            ],



        ]);
    }
}
