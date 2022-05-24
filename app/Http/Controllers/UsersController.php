<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request) 
    {
        $this->authorize('isAdmin');

        $search =  $request->input('q');
        if($search!=""){
            $data = User::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $data->appends(['q' => $search]);
        }
        else{
            $data = User::paginate(2);
        }
        return view('dashboard.users.index', [
            'title' => 'Pengguna',
            'data' => $data
        ]);
    }

    public function create()
    {
        $this->authorize('isAdmin');

        return view('dashboard.users.create',[
            'title' => 'Pengguna'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        
        $this->validate($request, [
            'nama_pengguna' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email|unique:users,email,',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->nama_pengguna,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'role' => $request->role
        ]);

        if ($user) {
            return redirect()
                ->route('users.index')
                ->with([
                    'success' => 'Berhasil dibuat!'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }

    public function edit($id)
    {
        $this->authorize('isAdmin');
        
        $row = User::findOrFail($id);

        return view('dashboard.users.edit',[
            'title' => 'Pengguna',
            'row' => $row
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        
        $this->validate($request, [
            'nama_pengguna' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|string'
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name' => $request->nama_pengguna,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role
        ];

        if($request->password != "" || !empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        if ($user) {
            return redirect()
                ->route('users.index')
                ->with([
                    'success' => 'Berhasil diupdate!'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');
        
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()
                ->route('users.index')
                ->with([
                    'success' => 'Berhasil dihapus!'
                ]);
        } else {
            return redirect()
                ->route('users.index')
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }
}
