<x-layout-admin>
  <div class="content-wrapper">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    {{-- Tabel Data Artikel --}}
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: 1rem;">
              <div class="card-header">
                <h3 class="card-title">Data Opsi Soal Pilihan Ganda Kuis Tantangan Bulanan</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>Soal Kuis</th>
                      <th>Label</th>
                      <th>Teks Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($opsi as $item)
                      <tr>
                        <td>{{ $item->soal_tantangan_bulanan->soal }}</td>
                        <td>{{ $item->label }}</td>
                        <td>{{ $item->teks_opsi }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $opsi->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    {{-- /.Tabel Data Artikel --}}
  </div>
</x-layout-admin>
