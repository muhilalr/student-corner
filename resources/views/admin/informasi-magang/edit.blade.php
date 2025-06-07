<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Informasi Magang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form method="POST" action="{{ route('admin_informasi-magang.update', $informasi_magang->id) }}">

                <div class="card-body">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi Magang" cols="30"
                      rows="10" required>{{ $informasi_magang->deskripsi }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="persyaratan">Persyaratan</label>
                    <textarea name="persyaratan" class="form-control" id="persyaratan" placeholder="Masukkan Persyaratan Magang"
                      cols="30" rows="10" required>{{ $informasi_magang->persyaratan }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="benefit">Benefit</label>
                    <textarea name="benefit" class="form-control" id="benefit" placeholder="Masukkan Benefit Magang" cols="30"
                      rows="10" required>{{ $informasi_magang->benefit }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="info_kontak">Info Kontak</label>
                    <textarea name="info_kontak" class="form-control" id="info_kontak" placeholder="Masukkan Info Kontak Magang"
                      cols="30" rows="10" required>{{ $informasi_magang->info_kontak }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-layout-admin>
