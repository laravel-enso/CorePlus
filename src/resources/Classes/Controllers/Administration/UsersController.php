<?php

namespace App\Http\Controllers\Administration;

use App\DataTable\UsersTableStructure;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateUserRequest;
use App\Owner;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use LaravelEnso\ActionLogger\app\Models\ActionHistory;
use LaravelEnso\DataTable\app\Traits\DataTable;
use LaravelEnso\Impersonate\app\Traits\Controller\Impersonate;

class UsersController extends Controller
{
    use SendsPasswordResetEmails, DataTable, Impersonate;

    protected $tableStructureClass = UsersTableStructure::class;

    public function getTableQuery()
    {
        $id = request()->user()->owner_id === 1 ?: 2;

        $query = User::select(\DB::raw('users.id as DT_RowId, owners.name owner, users.first_name, users.last_name, users.nin, users.phone, users.email, roles.name role, users.is_active'))
            ->join('owners', 'users.owner_id', '=', 'owners.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('owner_id', '>=', $id);

        return $query;
    }

    public function index()
    {
        return view('laravel-enso/core::pages.administration.users.index');
    }

    public function create()
    {
        $user = new User();

        $roles = [];

        $id = request()->user()->owner->id === 1 ?: 2;
        $owners = Owner::where('id', '>=', $id)->active()->pluck('name', 'id');

        return view('laravel-enso/core::pages.administration.users.create', compact('owners', 'user', 'roles'));
    }

    public function store(ValidateUserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->email = $request->email;
        $user->owner_id = $request->owner_id;
        $user->save();

        flash()->success(__('The User was created!'));

        $this->sendResetLinkEmail($request);

        return redirect('administration/users/'.$user->id.'/edit');
    }

    public function show(User $user)
    {
        $user->load('owner')
            ->load('role')
            ->load('avatar');

        $timeline = ActionHistory::whereUserId($user->id)->latest()->limit(10)->get();

        return view('laravel-enso/core::pages.administration.users.show', compact('user', 'timeline'));
    }

    public function edit(User $user)
    {
        $user->load('owner')
            ->load('role');

        // excluding "Admin" Owner for Users that do not belong to 'Admin'
        $id = request()->user()->owner->id === 1 ?: 2;
        $owners = Owner::where('id', '>=', $id)->active()->pluck('name', 'id');

        $roles = $user->owner->roles->pluck('name', 'id');

        return view('laravel-enso/core::pages.administration.users.edit', compact('user', 'roles', 'owners'));
    }

    public function update(ValidateUserRequest $request, User $user)
    {
        // $user->fill($request->all());

        $user->update($request->all());
        // $user->save();

        flash()->success(__('The Changes have been saved!'));

        return back();
    }

    public function updateProfile(ValidateUserRequest $request, User $user)
    {
        if (request()->user()->cannot('updateProfile', $user)) {
            flash()->warning(__('You are not authorized for this action'));

            return back();
        }

        $user->fill($request->all());
        $user->save();

        flash()->success(__('The Changes have been saved!'));

        return back();
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            $response = [
                'level'   => 'error',
                'message' => __('An error has occured. Please report this to the administrator'),
            ];
        }
        if (!isset($response)) {
            $response = [
                'level'   => 'success',
                'message' => __('Operation was successfull'),
            ];
        }

        return $response;
    }
}
