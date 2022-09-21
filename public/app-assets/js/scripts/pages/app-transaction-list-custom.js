$(function () {
  'use strict';

  var dtTransactionTable = $('.transaction-list-table');

  if (dtTransactionTable.length) {
    $.fn.dataTable.ext.errMode = 'throw';
    // $.ajaxSetup({
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });

    dtTransactionTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        type: 'GET',
        url: "transaksi/list",
      }, // JSON file to add data
      columns: [
        { data: 'team' },
        { data: 'logo' },
        { data: 'tournament' },
        { data: 'status' },
        { data: 'peserta' },
        { data: 'penyelenggara' },
        { data: 'bukti' },
        { data: '' }
      ],
      columnDefs: [
        {
          targets: 1,
          // responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['team'],
              $image = full['logo'];
            if ($image) {
              var base_url = window.location.origin;
              var $output =
                '<img src="' + base_url + "/storage/images/transaksi/logo/" + $image + '" alt="Avatar" height="32" width="32">';
            } else {
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['team'],
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
            var $status = full['status'];
            var icon;
            switch($status) {
              case 'waiting':
                icon = feather.icons['clock'].toSvg({ class: 'font-medium-3 text-secondary mr-50' });
                break;
              case 'reject':
                icon = feather.icons['x-circle'].toSvg({ class: 'font-medium-3 text-danger mr-50' });
                break;
              case 'valid':
                icon = feather.icons['check-circle'].toSvg({ class: 'font-medium-3 text-success mr-50' });
                break;
              default:
                icon = feather.icons['clock'].toSvg({ class: 'font-medium-3 text-secondary mr-50' });
                break;
            }

            return "<span class='text-truncate align-middle text-capitalize'>" + icon + $status + '</span>';
          }
        },
        {
          targets: 6,
          render: function (data, type, full, meta) {
            var $bukti = full['bukti'];

            if($bukti) {
              var base_url = window.location.origin;
              var $output = '<a href="' + base_url + "/storage/images/transaksi/bukti/" + $bukti + '" target="_blank" rel="noopener noreferrer">Lihat</a>';
            } else {
              var $output = "Tidak Ada";
            }

            return $output;
          }
        },
        {
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            var id_transaksi = full['id_transaksi'];
            return (
              '<div class="btn-group">' +
                '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="transaksi/detail/'+ id_transaksi +
                '" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Detail</a>' +
                '</div>' +
              '</div>'
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
        //   className: 'add-new btn btn-primary mt-50',
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

function hapus(e) {
  var url = 'user/delete/'+e;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
      title             : "Apakah Anda Yakin ?",
      text              : "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
      icon              : "warning",
      showCancelButton  : true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor : "#d33",
      confirmButtonText : "Ya, Tetap Hapus!"
  }).then((result) => {
    if (result.value) {
        $.ajax({
            url    : url,
            type   : "delete",
            success: function(data) {
              $('.user-list-table').DataTable().ajax.reload();
              Swal.fire({
                  icon: 'success',
                  title: 'Data User berhasil dihapus.',
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