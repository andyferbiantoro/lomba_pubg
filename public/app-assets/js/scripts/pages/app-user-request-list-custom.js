$(function () {
  'use strict';

  var dtUserTable = $('.user-list-table');
  var base_url = window.location.origin;

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        type: 'GET',
        url: "request-penyelenggara/list",
      }, // JSON file to add data
      columns: [
        // { data: 'id_user' },
        { data: 'nama' },
        { data: 'no_hp' },
        { data: 'email' },
        { data: 'role' },
        { data: 'alamat' },
        { data: '' }
      ],
      columnDefs: [
        {
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['nama'],
              $image = full['foto'];
            if ($image) {
              var $output =
                '<img src="' + base_url + "/storage/images/profile/" + $image + '" alt="Avatar" height="32" width="32">';
            } else {
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['nama'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-content">' + $initials + '</span>';
            }
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar ' +
              colorClass +
              ' mr-1">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="#" class="user_name text-truncate"><span class="font-weight-bold">' +
              $name +
              '</span></a>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $role = full['role'];
            var icon;
            switch($role) {
              case 'admin':
                icon = feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger mr-50' });
                break;
              case 'penyelenggara':
                icon = feather.icons['edit-2'].toSvg({ class: 'font-medium-3 text-info mr-50' });
                break;
              default:
                icon = feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary mr-50' });
                break;
            }

            return "<span class='text-truncate align-middle text-capitalize'>" + icon + $role + '</span>';
          }
        },
        {
          targets: -1,
          title: 'Aksi',
          orderable: false,
          render: function (data, type, full, meta) {
            var id_user = full['id_user'];
            var bukti = full['bukti_tf'];
            return (
              '<a href="' + base_url + "/storage/images/bukti-penyelenggara/" + bukti + '" class="btn btn-sm btn-warning mr-1" target="_blank">Lihat Bukti</a>' +
              '<button class="btn btn-sm btn-primary mr-1" type="button" onclick="validasi('+ id_user +')">validasi</button>' +
              '<button class="btn btn-sm btn-danger" type="button" onclick="reject('+ id_user +')">tolak</button>'
            );
          }
        }
      ],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
        '<"col-lg-12 col-xl-6" l>' +
        '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Cari',
        searchPlaceholder: 'Cari..'
      },
      // Buttons with Dropdown
      buttons: [
        // {
        //   text: 'Tambah User',
        //   className: 'add-new btn btn-primary mt-50 d-none',
        //   attr: {
        //     'data-toggle': 'modal',
        //     'data-target': '#modals-slide-in'
        //   },
        //   init: function (api, node, config) {
        //     $(node).removeClass('btn-secondary');
        //   }
        // }
      ],
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }
  
});

function validasi(e) {
  var url = 'request-penyelenggara/validasi/'+e;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
      title             : "Apakah Anda Yakin Validasi ?",
      text              : "",
      icon              : "warning",
      showCancelButton  : true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor : "#d33",
      confirmButtonText : "Ya"
  }).then((result) => {
    if (result.value) {
        $.ajax({
            url    : url,
            type   : "put",
            success: function(data) {
              $('.user-list-table').DataTable().ajax.reload();
              Swal.fire({
                  icon: 'success',
                  title: 'Penyelenggara berhasil di validasi',
                  showConfirmButton: false,
                  timer: 2200,
                  customClass: {
                  confirmButton: 'btn btn-primary'
                  },
                  buttonsStyling: false
              });
            }
        })
    }
  })
}

function reject(e) {
  var url = 'request-penyelenggara/reject/'+e;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
      title             : "Apakah Anda Yakin Tolak ?",
      text              : "",
      icon              : "warning",
      showCancelButton  : true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor : "#d33",
      confirmButtonText : "Ya"
  }).then((result) => {
    if (result.value) {
        $.ajax({
            url    : url,
            type   : "put",
            success: function(data) {
              $('.user-list-table').DataTable().ajax.reload();
              Swal.fire({
                  icon: 'success',
                  title: 'Bukti Penyelenggara berhasil di tolak',
                  showConfirmButton: false,
                  timer: 2200,
                  customClass: {
                  confirmButton: 'btn btn-primary'
                  },
                  buttonsStyling: false
              });
            }
        })
    }
  })
}