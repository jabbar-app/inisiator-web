<div class="mb-3">
  @if (session('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Berhasil!
      </strong> {{ session('success') }}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @elseif(session('info'))
    <div class="alert alert-info dark alert-dismissible fade show" role="alert"><strong>Info!
      </strong> {{ session('info') }}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @elseif (session('danger') || session('error'))
    <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
      <strong>Gagal!</strong> {{ session('danger') ?? session('error') }}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
      <strong>Oops! Ada beberapa kesalahan:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
