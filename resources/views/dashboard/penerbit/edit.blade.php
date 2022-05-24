@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    Edit <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="{{ route('penerbit.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="penerbit" class="col-sm-2 col-form-label text-end">Penerbit <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit', $row->nama) }}" >
                                
                                @error('penerbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label text-end">Alamat</label>
                            <div class="col-sm-5">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', $row->alamat) }}</textarea>
                                
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_tlp" class="col-sm-2 col-form-label text-end">No Tlp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" name="no_tlp" value="{{ old('no_tlp', $row->no_tlp) }}" >
                                
                                @error('no_tlp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 offset-md-2 mt-2">
                            <button type="submit" class="btn btn-md btn-primary">Ubah</button>
                            <a href="{{ route('penerbit.index') }}" class="btn btn-md btn-secondary">kembali</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
