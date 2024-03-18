<div class="modal fade" id="ctaModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><?php echo $title ?></h5>
        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_cta_form" enctype="multipart/form-data">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $encId; ?>">
          </div>
          <div id="error_message" class="alert alert-danger" style="display: none;"></div>
          <br />
          <div class="col-12 form-group">
            <label for="nama" class="form-label">Nama <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $cta->nama; ?>" placeholder="Nama">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="link" class="form-label">Link <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="link" name="link" value="<?= $cta->link; ?>" placeholder="Link sosmed">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="edit_cta_form" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#edit_cta_form').submit(function(e) {
      e.preventDefault();

      var formData = $(this).serialize();
      var nama = document.getElementById('nama');
      var link = document.getElementById('link');

      if (nama.value == "") {
        $('#error_message').text('Nama tidak boleh kosong!').show();
        return false;
      }

      if (link.value == "") {
        $('#error_message').text('Link tidak boleh kosong!');
        return false;
      }

      $.ajax({
        type: 'POST',
        url: '<?= base_url('ctasosmed/update'); ?>', // Ganti dengan URL yang sesuai untuk memproses form
        data: formData,
        success: function(response) {
          // Menampilkan SweetAlert setelah berhasil menyimpan FAQ
          Swal.fire({
            icon: 'success',
            title: 'CTA berhasil diubah!',
            showConfirmButton: true,
            timer: 150000
          }).then(function() {
            window.location.href = '<?= base_url('ctasosmed'); ?>';
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