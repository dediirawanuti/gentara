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
        <form id="add_cta_form" enctype="multipart/form-data">
          <div id="error_message" class="alert alert-danger" style="display: none;"></div>
          <br />
          <div class="form-group">
            <input type="hidden" name="id">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="nama" class="form-label">Nama <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="link" class="form-label">Link <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Link sosmed">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add_cta_form" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#add_cta_form').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
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
        url: '<?= base_url('ctasosmed/add'); ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'CTA Berhasil disimpan!',
            showConfirmButton: false,
            timer: 1500
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