<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manajemen Logo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item">Manajemen CTA</li>
        <li class="breadcrumb-item active">list CTA</li>
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
                <button type="button" data-toggle="modal" data-target="#addCtaModal" class="btn btn-primary btn-modaladdcta">Tambah CTA</button>
              </div>
            </div>
            <table width="100%" id="cta_table" class="table">
              <thead>
                <tr>
                  <th>Nama </th>
                  <th>Link</th>
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
    $(document).on('click', '.btn-modaladdcta', function(e) {
      e.preventDefault();
      var id = $(this).data('id');

      if (id == '') {
        var url = 'ctasosmed/form';
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url('ctasosmed/form'); ?>",
        data: {
          id: id
        },
        success: function(response) {
          $('body').append(response);
          var modal = new bootstrap.Modal($('#ctaModal'));
          modal.show();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });

    $('#add_cta_form').submit(function(e) {
      e.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: "<?= base_url('ctasosmed/add'); ?>",
        data: new formData(this),
        contentType: false,
        processData: false,
        success: function(response) {
          if (response == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Suksess',
              text: 'CTA berhasil ditambahkan!',
              onclose: function() {
                $('#add_cta_form')[0].reset();
                table.ajax.reload();
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi kesalahan'
            })
          }
        }
      });
    });

    var table = $('#cta_table').DataTable({
      processing: true,
      serverSide: false,
      bDestroy: true,
      responsive: true,
      searching: true,
      ajax: "<?php echo base_url('ctasosmed/datatables'); ?>",
      order: [],
      // "ajax": "<?= base_url('user/datatables'); ?>",
      "columns": [{
          "data": "nama"
        },
        {
          "data": "link"
        },
        {
          "data": null,
          "render": function(data, type, full, meta) {
            var id = full.id;
            return '<button type="button" class="btn btn-sm btn-primary btn-modaladdcta" data-id="' + id + '">Edit</button>' + ' ' +
              '<a href="#" class="btn btn-sm btn-danger delete" data-id="' + full.id + '">Hapus</a>';
          },
        }
      ]
    });

    // Mengedit pengguna
    // $('#cta_table tbody').on('click', '.edit', function(e) {
    //   e.preventDefault();
    //   var id = $(this).data('id');
    //   // Mendapatkan data pengguna berdasarkan ID menggunakan permintaan AJAX
    //   window.location.href = "<?php echo base_url('ctasosmed/form_edit/'); ?>" + id;
    // });

    $('#edit_cta_form').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?= base_url('ctasosmed/update'); ?>",
        contentType: false,
        processData: false,
        data: formData,
        success: function(response) {
          if (response == "true") {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'CTA berhasil diubah!',
              onclose: function() {
                $('#editModal').modal('hide');
                table.ajax.reload();
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi kesalahan!'

            })
          }
        }
      });
    });



  });
</script>