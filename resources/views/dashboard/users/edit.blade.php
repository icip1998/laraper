@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="nama_pengguna" class="col-sm-2 col-form-label text-end">Nama Pengguna <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('nama_pengguna') is-invalid @enderror" name="nama_pengguna" value="{{ old('nama_pengguna', $row->name) }}" >
                                
                                @error('nama_pengguna')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="username" class="col-sm-2 col-form-label text-end">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $row->username) }}" >
                                
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label text-end">Password </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" >
                                
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label text-end">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $row->email) }}" >
                                
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="role" class="col-sm-2 col-form-label text-end">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="">--Pilih role---</option>
                                    <option value="admin" {{ ($row->role == 'admin' ? 'selected' : '') }}>Admin</option>
                                    <option value="member" {{ ($row->role == 'member' ? 'selected' : '') }}>Member</option>
                                </select>
                                
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 offset-md-2 mt-2">
                            <button type="submit" class="btn btn-md btn-primary">Ubah</button>
                            <a href="{{ route('users.index') }}" class="btn btn-md btn-secondary">kembali</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
