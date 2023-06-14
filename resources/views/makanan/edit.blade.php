@extends('layout.template')
@section('konten')
    <form action="{{ url('makanan/'.$food->id) }}" method="POST" enctype="multipart/form-data" style="background: rgb(221, 228, 238)" class="p-3">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-center">
            <h2 style="color: rgb(118, 118, 255)">Edit Data</h2>
        </div>

        <div class="container bg-body mt-1 p-3 rounded shadow">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label" style="font-weight: bold">Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="id" id="" disabled value="{{ $food->id }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label" style="font-weight: bold">Nama</label> 
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $food->name }}">

                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="price" class="col-sm-2 col-form-label" style="font-weight: bold">Price</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="price" id="price" value="{{ $food->price }}">

                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label" style="font-weight: bold">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $food->description }}</textarea>
                    
                    @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="qty" class="col-sm-2 col-form-label" style="font-weight: bold">Qty</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="qty" id="qty" value="{{ $food->qty }}">

                    @error('qty')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label" style="font-weight: bold">Gambar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="" value="{{ Storage::url('public/makanans/').$food->image }}">
                    
                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex bd-highlight bg-body mt-3 p-1 rounded shadow">
            <div class="p-2 flex-grow-1 bd-highlight">
                <button class="btn btn-outline-primary" type="submit">SIMPAN</button>
            </div>
            <div class="p-2 bd-highlight">
                <button class="btn btn-outline-danger" type="reset">RESET</button>
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{ url('makanan') }}" class="btn btn-outline-warning">KEMBALI</a>
            </div>
        </div>
    </form>
@endsection