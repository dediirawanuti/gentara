<div class="modal fade" id="logoModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><?php echo $title ?></h5>
        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_logo_form" enctype="multipart/form-data">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $encId; ?>">
          </div>
          <div id="error_message" class="alert alert-danger" style="display: none;"></div>
          <br />
          <div class="col-12 form-group">
            <label for="nama" class="form-label">Nama *</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $logo['nama']; ?>">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="deskripsi" class="form-label">Deskripsi *</label>
            <textarea class="form-control" style="height: 143px;" id="deskripsi" name="deskripsi" spellcheck="false"><?= $logo['deskripsi']; ?></textarea>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="alt_text" class="form-label">Alternative Text *</label>
            <input type="text" class="form-control" id="alt_text" name="alt_text" placeholder="alternative text" value="<?= $logo['alt_text']; ?>">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="gambar" class="form-label">Gambar *</label>
            <div class="col-12">
              <?php if (!empty($logo['gambar'])) : ?>
                <img src="<?= base_url('assets/uploads/cms/image/logo/') . $logo['gambar']; ?>" width="100">
              <?php endif; ?>
            </div>
            <br />
            <input type="file" name="gambar" id="gambar" class="form-control" value="<?= base_url(''); ?>" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="edit_logo_form" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#edit_logo_form').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      var nama = document.getElementById('nama');
      var deskripsi = document.getElementById('deskripsi');
      var alt_text = document.getElementById('alt_text');

      if (nama.value == "") {
        $('#error_message').text('Nama tidak boleh kosong!').show();
        // alert('Nama tidak boleh kosong!');
        return false;
      }

      if (deskripsi.value == "") {
        $('#error_message').text('Deskripsi tidak boleh kosong!').show();
        return false;
      }

      if (alt_text.value == "") {
        $('#error_message').text('Alternatif teks tidak boleh kosong!').show();
        return false;
      }

      $.ajax({
        type: 'POST',
        url: '<?= base_url('logo/update'); ?>', // Ganti dengan URL yang sesuai untuk memproses form
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          // Menampilkan SweetAlert setelah berhasil menyimpan FAQ
          Swal.fire({
            icon: 'success',
            title: 'Logo berhasil diubah!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
            window.location.href = '<?= base_url('logo'); ?>';
          });
        },
        error: function(xhr, status, error) {
          $('#error_message').text('Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.').show();
          console.log(error);
        }
      });
    });
  })
</script>