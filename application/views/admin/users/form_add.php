<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><?php echo $title ?></h5>
        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_user_form" enctype="multipart/form-data">
          <div class="form-group">
            <input type="hidden" name="id">
          </div>
          <!-- <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div> -->
          <div class="col-12 form-group">
            <label for="nama" class="form-label">Nama *</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
          </div>
          <br />
          <!-- <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div> -->
          <div class="col-12 form-group">
            <label for="email" class="form-label">Email *</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
          </div>
          <br />

          <div class="col-12 form-group">
            <label for="username" class="form-label">Username *</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="password" class="form-label">Password *</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>
          <br />
          <div class="col-12 form-group">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
              <option value="admin">admin</option>
              <option value="user">user</option>
            </select>
          </div>
          <!-- <br />
          <div class="col-12 form-group">
            <label for="foto" class="form-label">Foto </label>
            <input type="file" class="form-control" name="foto">
          </div> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add_user_form" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#add_user_form').submit(function(e) {
      e.preventDefault(); // Mencegah reload halaman saat submit form
      var formData = $(this).serialize(); // Mengambil data form
      var nama = document.getElementById('nama');
      var username = document.getElementById('username');
      var email = document.getElementById('email');
      var password = document.getElementById('password');
      var role = document.getElementById('role');
      if (nama.value == "") {
        alert('Nama tidak boleh kosong!');
        return false;
      }

      if (username.value == "") {
        alert('Username tidak boleh kosong!');
        return false;
      }

      if (email.value == "") {
        alert('Email tidak boleh kosong!');
        return false;
      }

      if (password.value == "") {
        alert('Password tidak boleh kosong!');
        return false;
      }

      $.ajax({
        url: '<?= base_url('users/add'); ?>', // Ganti dengan URL yang sesuai untuk memproses form
        type: 'POST',
        data: formData,
        success: function(response) {
          // Menampilkan SweetAlert setelah berhasil menyimpan FAQ
          Swal.fire({
            icon: 'success',
            title: 'User berhasil disimpan!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
            window.location.href = '<?= base_url('users'); ?>';
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