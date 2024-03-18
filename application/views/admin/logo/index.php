<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manajemen Logo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item">Manajemen Logo</li>
        <li class="breadcrumb-item active">list Logo</li>
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
                <button type="button" data-toggle="modal" data-target="#addLogoModal" class="btn btn-primary btn-modaladdlogo">Tambah Logo</button>
              </div>
            </div>
            <table width="100%" id="logo_table" class="table">
              <thead>
                <tr>
                  <th>Nama Logo</th>
                  <th>Deskripsi</th>
                  <th>Allternative Text</th>
                  <th>Gambar</th>
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

    var table = $('#logo_table').DataTable({
      processing: true,
      serverSide: false,
      bDestroy: true,
      responsive: true,
      searching: true,
      ajax: "<?php echo base_url('logo/datatables'); ?>",
      order: [],
      // "ajax": "<?= base_url('user/datatables'); ?>",
      "columns": [{
          "data": "nama"
        },
        {
          "data": "deskripsi"
        },
        {
          "data": "alt_text"
        },
        {
          "data": "gambar",
          "render": function(data, type, row) {
            if (data) {
              return '<img src="assets/uploads/cms/image/logo/' + data + '" width="100">';
            } else {
              return '';
            }
          }
        },
        {
          "data": null,
          "render": function(data, type, full, meta) {
            var id = full.id;
            return '<button type="button" class="btn btn-sm btn-primary btn-modaladdlogo" data-id="' + id + '">Edit</button>' + ' ' +
              '<a href="#" class="btn btn-sm btn-danger delete" data-id="' + full.id + '">Hapus</a>';
          }
        }
      ]
    });

    $(document).on('click', '.btn-modaladdlogo', function(e) {
      e.preventDefault();
      var id = $(this).data('id');

      if (id == '') {
        var url = 'logo/form_add';
      }
      $.ajax({
        url: '<?= base_url('logo/form_add'); ?>',
        method: "POST",
        data: {
          id: id
        },
        success: function(response) {
          $('body').append(response);
          var modal = new bootstrap.Modal($('#logoModal'));
          modal.show();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });

    $('#add_logo_form').submit(function(event) {
      event.preventDefault();
      // Serialize form data
      var formData = $(this).serialize();
      // Send AJAX request
      $.ajax({
        url: '<?php echo base_url('logo/add'); ?>',
        type: 'POST',
        data: new formData(this),
        contentType: false,
        processData: false,
        success: function(data) {
          if (data == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Logo berhasil ditambahkan!',
              onClose: function() {
                $('#add_logo_form')[0].reset();
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
        },
      });
    });

    // Mengedit pengguna
    // $('#logo_table tbody').on('click', '.edit', function(e) {
    //   e.preventDefault();
    //   var id = $(this).data('id');
    //   // Mendapatkan data pengguna berdasarkan ID menggunakan permintaan AJAX
    //   window.location.href = "<?php echo base_url('logo/form_edit/') ?>" + id;
    // });

    $('#edit_logo_form').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      // var formData = $(this).serialize();

      $.ajax({
        url: "<?php echo base_url('logo/update'); ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
          if (data == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Logo berhasil diubah!',
              onClose: function() {
                $('#editModal').modal('hide');
                table.ajax.reload();
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi Kesalahan!'
            })
          }
        }
      });
    });

    $('#logo_table tbody').on('click', '.delete', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      Swal.fire({
        title: 'konfirmasi',
        text: 'Anda yakin ingin menghapus logo ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= base_url('logo/delete'); ?>",
            data: {
              id: id
            },
            success: function(data) {
              if (data == "true") {
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Logo berhasil dihapus!',
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
      })
    });
  })
</script>