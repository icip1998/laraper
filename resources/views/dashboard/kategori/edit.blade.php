@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    Edit <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-2 col-form-label text-end">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori', $row->nama) }}" >
                                
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 offset-md-2 mt-2">
                            <button type="submit" class="btn btn-md btn-primary">Ubah</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-secondary">kembali</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
