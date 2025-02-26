{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')
@endsection
@section('content')
    <div class="nk-fmg-body-head d-none d-lg-flex">
        <div class="nk-fmg-search">
            <!-- <em class="icon ni ni-search"></em> -->
            <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
            <h4 class="card-title text-primary"><i class='{{ $icon }}' data-toggle='tooltip' data-placement='bottom'
                    title='{{ $subtitle }}'></i> {{ strtoupper($subtitle) }}</h4>
        </div>
        <div class="nk-fmg-actions">
            <div class="btn-group">
                <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
                <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
                <a href="{{ route('crud.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em
                        class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
            </div>
        </div>
    </div>
    <div class="row gy-3 d-none" id="loaderspin">
        <div class="col-md-12">
            <div class="col-md-12" align="center">
                &nbsp;
            </div>
            <div class="d-flex align-items-center">
                <div class="col-md-12" align="center">
                    <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
            <div class="col-md-12" align="center">
                <strong>Loading...</strong>
            </div>
        </div>
    </div>
    <div class="card d-none" id="filterrow">
        <div class="card-body" style="background:#f7f9fd">
            <div class="row gy-3">

            </div>
        </div>
        <!-- <div class="card-footer" style="background:#fff" align="right"> -->
        <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
            <div class="btn-group">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em
                        class="icon ti-reload"></em> <span>Submit Filter</span></a>
            </div>
        </div>
    </div>

    <!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <form name="formPendaftaran" action="{{ url('/crud/save') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <input type="text" class="form-control @error("nim") is-invalid @enderror" name="nim" value="{{ old("nim") }}" id="nim" >
                        @error('nim')
                             <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <input type="text" class="form-control @error("nama") is-invalid @enderror" name='nama' value="{{ old('nama') }}" id="nama" >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name='alamat' value="{{ old('alamat') }}" id="alamat" >
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 row">
                        <div class="col-sm-5"><a title='Tambah Data' href='javascript:void(0)' onclick='store()' class='btn btn-primary'>Simpan</a></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- </div> -->
@endsection
@push('script')
<script>


function store(){
        // var nim = document.getElementById("nim").value;
        if (document.forms["formPendaftaran"]["nim"].value == "") {
                CustomSwal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NIM Tidak Boleh Kosong',
                })
                document.forms["formPendaftaran"]["nim"].focus();
                return false;
            }
        if (document.forms["formPendaftaran"]["nim"].value =="") {
                CustomSwal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NIM Sudah Ada',
                })
                document.forms["formPendaftaran"]["nim"].focus();
                return false;
        }  
            if (document.forms["formPendaftaran"]["nama"].value == "") {
                CustomSwal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama Tidak Boleh Kosong',
                })
                document.forms["formPendaftaran"]["nama"].focus();
                return false;
            }
            if (document.forms["formPendaftaran"]["alamat"].value == "") {
                CustomSwal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Alamat Tidak Boleh Kosong',
                })
                document.forms["formPendaftaran"]["alamat"].focus();
                return false;
            }

    // buttonsmdisable(elm);
    CustomSwal.fire({
        icon:'question',
        text: 'Apakah Data Sudah Benar, '+document.forms["formPendaftaran"]["nama"].value+' ?',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('/crud/save')}}",
                data:{
                    _method:"POST",
                    _token:"{{csrf_token()}}",
                    nim:$("#nim").val(),
                    nama:$("#nama").val(),
                    alamat:$("#alamat").val(),
                },
                type:"POST",
                dataType:"JSON",
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success').then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace("{{ url('crud') }}");
                            }
                        });
                    }
                    else
                    {
                        CustomSwal.fire('Gagal', data.msg, 'error');
                    }
                },
                error:function(error){
                    CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                    console.log(error.XMLHttpRequest);
                },
            });
        }
    });
}
</script>
@endpush