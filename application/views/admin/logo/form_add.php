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
        <form id="add_logo_form" enctype="multipart/form-data">
          <div id="error_message" class="alert alert-danger" style="display: none;"></div>
          <br />
          <div class="col-12 form-group">
            <label for="nama" class="form-label">Nama <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="deskripsi" class="form-label">Deskripsi <span style="color: red;">*</span></label>
            <textarea class="form-control" style="height: 143px;" id="deskripsi" name="deskripsi" spellcheck="false"></textarea>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="alt_text" class="form-label">Alternative Text <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="alt_text" name="alt_text" placeholder="Alternatif Teks">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="gambar" class="form-label">Gambar <span style="color: red;">*</span></label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add_logo_form" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#add_logo_form').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      var nama = document.getElementById('nama');
      var deskripsi = document.getElementById('deskripsi');
      var alt_text = document.getElementById('alt_text');
      var gambar = document.getElementById('gambar');

      if (nama.value == "") {
        $('#error_message').text('Nama tidak boleh kosong!').show();
        return false;
      }

      if (deskripsi.value == "") {
        $('#error_message').text('Deskripsi tidak boleh kosong!');
        return false;
      }

      if (alt_text.value == "") {
        $('#error_message').text('Alternative Text tidak boleh kosong!');
        return false;
      }

      if (gambar.value == "") {
        $('#error_message').text('Gambar tidak boleh kosong!');
        return false;
      }

      $.ajax({
        url: '<?= base_url('logo/add'); ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Logo Berhasil disimpan!',
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