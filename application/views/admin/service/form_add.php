<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><?php echo $title ?></h5>
        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_service_form" enctype="multipart/form-data">
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
            <label for="gambar" class="form-label">Gambar *</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add_service_form" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // Menambahkan pengguna baru
    $('#add_service_form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var judul = document.getElementById('judul');
      var isi = document.getElementById('isi');

      if (judul.value == "") {
        alert('Judul tidak boleh kosong!')
        return false;
      }

      if (isi.value == "") {
        alert('Isi tidak boleh kosong!')
        return false;
      }

      $.ajax({
        url: "<?php echo base_url('serviceadmin/form_add'); ?>",
        method: "POST",
        data: formData,
        success: function(data) {
          // Menampilkan SweetAlert setelah berhasil menyimpan FAQ
          Swal.fire({
            icon: 'success',
            title: 'Service berhasil disimpan!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
            window.location.href = '<?= base_url('serviceadmin'); ?>';
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>