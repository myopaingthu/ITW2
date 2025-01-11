<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query();
            return Datatables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->format(config('constants.date_format.detail_date_format'));
                })
                ->editColumn('updated_at', function ($user) {
                    return Carbon::parse($user->updated_at)->format(config('constants.date_format.detail_date_format'));
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row m-sm-n1">';
                    $btn = $btn . '<div class="my-1 button-box text-center">
                            <a rel="tooltip" class="button-size btn btn-sm btn-primary"
                            href="' . route('users.edit', [$row->id]) . '" data-original-title="" title="Edit">
                            <i class="fas fa-edit"></i>
                            </a>
                        </div>';
                    $btn = $btn . '<div class="my-1 button-box text-center mx-1"><form action="' . route('users.destroy', $row->id) . '" method="POST" id="del-role-' . $row->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="button-size btn btn-sm btn-danger destroy_btn" data-original-title="" data-origin="del-role-' . $row->id . '" title="Delete" data-text="Are you sure you want to delete  ' . $row->name . ' ?">
                                <i class="fas fa-trash"></i>
                                </button>
                            </form></div>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()
            ->route('users.index')
            ->withSuccess('User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        User::where('id', $id)
            ->update($data);
        return redirect()
            ->route('users.index')
            ->withSuccess('User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('users.index')
            ->withSuccess('User deleted successfully.');
    }
}
