<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><?php echo $title ?></h5>
        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_news_form" enctype="multipart/form-data">
          <div class="col-12 form-group">
            <label for="judul" class="form-label">Judul *</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="isi" class="form-label">Isi *</label>
            <textarea class="form-control" style="height: 143px;" id="isi" name="isi" spellcheck="false" required></textarea>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="penulis" class="form-label">Penulis *</label>
            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" required>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="tanggal_posting" class="form-label">Tanggal *</label>
            <input type="date" class="form-control" id="tanggal_posting" name="tanggal_posting" placeholder="Tanggal" required>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="gambar" class="form-label">Gambar *</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add_news_form" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#add_news_form').submit(function(e) {
      e.preventDefault(); // Mencegah reload halaman saat submit form
      var formData = $(this).serialize(); // Mengambil data form
      var judul = document.getElementById('judul');
      var isi = document.getElementById('isi');
      var penulis = document.getElementById('penulis');

      if (judul.value == "") {
        alert('Judul tidak boleh kosong!');
        return false;
      }

      if (isi.value == "") {
        alert('Isi tidak boleh kosong!');
        return false;
      }

      if (penulis.value == "") {
        alert('Penulis tidak boleh kosong!');
        return false;
      }

      $.ajax({
        url: '<?= base_url('newsadmin/add'); ?>', // Ganti dengan URL yang sesuai untuk memproses form
        type: 'POST',
        data: formData,
        success: function(response) {
          // Menampilkan SweetAlert setelah berhasil menyimpan FAQ
          Swal.fire({
            icon: 'success',
            title: 'News berhasil disimpan!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
            window.location.href = '<?= base_url('newsadmin'); ?>';
          });
          // Tambahkan kode lain yang ingin Anda lakukan setelah menyimpan FAQ
        },
        error: function(xhr, status, error) {
          // Tambahkan kode untuk menangani error saat melakukan request Ajax
          console.log(error);
        }
      });
    });
  })
</script>