<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Actions\Fortify\PasswordValidationRules;

class UserController extends Controller
{
    /* use PasswordValidationRules; */

   /*  public function __construct()
    {
        //userPolicy
        $this->authorizeResource(User::class);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,role']
        ]);

        $query = User::query();

        if(request('search')){
            $query->where('name','LIKE', '%'.request('search').'%')
                  ->orWhere('email','LIKE', '%'.request('search').'%');
        }

        if(request()->has(['field','direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('User/index',[
            'users' => $query->paginate(),
            'filters' => request()->all(['search','field','direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create(
            $request->validate([
                'name' => ['required', 'max:50'],
                'password' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email','unique:users'],
            ])
        );

        return Redirect::route('gestionnaire.index')->with('success','Félicitation, l\'utilisateur a été crée avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::findOrFail($id);

        return Inertia::render('User/edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);

        $user->update($request->all());

        return Redirect::route('gestionnaire.index')->with('warning','Le gestionnaire a été modifié!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return Redirect::route('gestionnaire.index')->with('danger','Le gestionnaire a été supprimé!');
    }
}