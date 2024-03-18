<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manajemen User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item active">list User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-between mb-2">
              <div class="col-auto"></div>
              <div class="col-auto m-3">
                <button type="button" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-modaladduser">Tambah User</button>
              </div>
            </div>
            <table width="100%" id="user_table" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<script type="text/javascript">
  $(document).ready(function() {

    $(document).on('click', '.btn-modaladduser', function(e) {
      e.preventDefault();
      var id = $(this).data('id');

      if (id == '') {
        var url = 'users/form_add';
      }
      $.ajax({
        url: '<?= base_url('users/form_add'); ?>',
        method: "POST",
        data: {
          id: id
        },
        success: function(response) {
          $('body').append(response);
          var modal = new bootstrap.Modal($('#userModal'));
          modal.show();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });

    var table = $('#user_table').DataTable({
      processing: true,
      serverSide: false,
      bDestroy: true,
      responsive: true,
      searching: true,
      ajax: "<?php echo base_url('users/datatables'); ?>",
      order: [],
      // "ajax": "<?= base_url('user/datatables'); ?>",
      "columns": [{
          "data": "no",
          orderable: false,
        },
        {
          "data": "nama"
        },
        {
          "data": "username"
        },
        {
          "data": "role"
        },
        {
          "data": "foto",
          "render": function(data, type, row) {
            if (data) {

              return '<img src="assets/cms/img/profile/' + data + '" width="100">';
            } else {
              return '';
            }
          }
        },
        {
          "data": null,
          "render": function(data, type, full, meta) {
            var id = full.id;
            return '<button type="button" class="btn btn-sm btn-primary btn-modaladduser" data-id="' + id + '">Edit</button>' + ' ' +
              '<a href="#" class="btn btn-sm btn-danger delete" data-id="' + full.id + '">Hapus</a>';
          }
        }
      ]
    });

    // Menambahkan pengguna baru
    $('#add_user_form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url('users/form_add'); ?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data) {
          if (data == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Pengguna berhasil ditambahkan!',
              onClose: function() {
                $('#add_user_form')[0].reset();
                table.ajax.reload();
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi kesalahan!'
            });
          }
        }
      });
    });

    // Mengedit pengguna
    $('#user_table tbody').on('click', '.edit', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      // Mendapatkan data pengguna berdasarkan ID menggunakan permintaan AJAX
      window.location.href = "<?php echo base_url('users/form_edit/'); ?>" + id;
    });

    // Menyimpan perubahan pengguna setelah edit
    $('#edit_user_form').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        url: "<?php echo base_url('users/update'); ?>",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          if (data == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Pengguna berhasil diedit!',
              onClose: function() {
                $('#editModal').modal('hide');
                table.ajax.reload();
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi kesalahan!'
            });
          }
        }
      });
    });

    // Menghapus pengguna
    $('#user_table tbody').on('click', '.delete', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin menghapus pengguna ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "<?php echo base_url('users/delete'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(data) {
              if (data == "true") {
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Pengguna berhasil dihapus!',
                  onClose: function() {
                    table.ajax.reload();
                  }
                }).then(function() {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Terjadi kesalahan!'
                });
              }
            }
          });
        }
      });
    });
  });
</script>