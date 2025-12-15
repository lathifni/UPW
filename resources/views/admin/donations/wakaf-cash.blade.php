<x-layouts.admin>
    <x-slot:title>Test</x-slot:title>
  <div class="container-fluid">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 fw-bold text-primary">Input Wakaf Tunai (Offline)</h6>
          </div>
          <div class="card-body">
              <form action="{{ route('admin.donations.cash.store') }}" method="POST">
                  @csrf
                  
                  {{-- Pilih Program --}}
                  <div class="mb-3">
                      <label class="form-label fw-bold">Pilih Program</label>
                      <select name="program_id" class="form-control" required>
                          <option value="">-- Pilih Program Tujuan --</option>
                          @foreach($programs as $program)
                              <option value="{{ $program->id }}">{{ $program->title }}</option>
                          @endforeach
                      </select>
                  </div>

                  {{-- Data Donatur --}}
                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">Nama Wakif</label>
                          <input type="text" name="donor_name" class="form-control" placeholder="Misal: Hamba Allah / Budi" required>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">Email (Opsional)</label>
                          <input type="email" name="donor_email" class="form-control" placeholder="Kosongkan jika tidak ada">
                          <small class="text-muted">Jika diisi, notifikasi terima kasih akan dikirim ke email ini.</small>
                      </div>
                  </div>

                  {{-- Nominal --}}
                  <div class="mb-4">
                      <label class="form-label fw-bold">Nominal Uang Tunai (Rp)</label>
                      <div class="input-group">
                          <span class="input-group-text">Rp</span>
                          <input type="number" name="amount" class="form-control" placeholder="0" min="10000" required>
                      </div>
                  </div>

                  <div class="d-flex justify-content-end">
                      <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary mr-2">Batal</a>
                      <button type="submit" class="btn btn-primary">
                          <i class="bi bi-save me-1"></i> Simpan Wakaf Tunai
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</x-layouts.admin>