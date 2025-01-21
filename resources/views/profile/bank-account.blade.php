@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="alert alert-primary alert-dismissible" role="alert">
        <h5 class="alert-heading fw-bold mb-2">ようこそ, {{ explode(' ', Auth::user()->name)[0] }}-kun!</h5>
        <p class="mb-0">
          Saldo kamu saat ini belum mencapai batas minimum untuk memverifikasi Nomor Rekening. Ayo, terus posting artikel
          dan tingkatkan penghasilan kamu hingga mencapai estimasi minimal Rp500.000,- untuk mulai menambahkan Nomor
          Rekening!
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endsection
