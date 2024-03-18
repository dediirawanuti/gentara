<main id="main" class="main">
  <div class="pagetitle">
    <h1><?= $title; ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item"><?= $title; ?></li>
        <li class="breadcrumb-item active">list News</li>
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
                <button type="button" data-toggle="modal" data-target="#addNewsModal" class="btn btn-primary btn-modaladdnews">Tambah News</button>
              </div>
            </div>
            <table width="100%" id="news_table" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Isi</th>
                  <th>Author</th>
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

    $(document).on('click', '.btn-modaladdnews', function(e) {
      e.preventDefault();
      var id = $(this).data('id');

      if (id == '') {
        var url = 'newsadmin/form_add';
      }
      $.ajax({
        url: '<?= base_url('newsadmin/form_add'); ?>',
        method: "POST",
        data: {
          id: id
        },
        success: function(response) {
          $('body').append(response);
          var modal = new bootstrap.Modal($('#newsModal'));
          modal.show();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });

    var table = $('#news_table').DataTable({
      processing: true,
      serverSide: false,
      bDestroy: true,
      responsive: true,
      searching: true,
      ajax: "<?php echo base_url('newsadmin/datatables'); ?>",
      order: [],
      // "ajax": "<?= base_url('user/datatables'); ?>",
      "columns": [{
          "data": "id",
          orderable: false,
        },
        {
          "data": "judul"
        },
        {
          "data": "isi"
        },
        {
          "data": "penulis"
        },
        {
          "data": "gambar",
          "render": function(data, type, row) {
            if (data) {
              return '<img src="assets/uploads/cms/image/news/' + data + '" width="100">';
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
    $('#add_news_form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url('newsadmin/form_add'); ?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data) {
          if (data == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'News berhasil ditambahkan!',
              onClose: function() {
                $('#add_news_form')[0].reset();
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
    $('#news_table tbody').on('click', '.edit', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      // Mendapatkan data pengguna berdasarkan ID menggunakan permintaan AJAX
      window.location.href = "<?php echo base_url('newsadmin/form_edit/'); ?>" + id;
    });

    // Menyimpan perubahan pengguna setelah edit
    $('#edit_news_form').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        url: "<?php echo base_url('newsadmin/update'); ?>",
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
    $('#news_table tbody').on('click', '.delete', function(e) {
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
            url: "<?php echo base_url('newsadmin/delete'); ?>",
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