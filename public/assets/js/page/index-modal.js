"use strict";

// manajemen meja

$("#createTableButton").fireModal({
  title: 'Tambah meja',
  body: $("#createTableModal"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      type: "submit",
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});
$("#editTableButton").fireModal({
  title: 'Edit Nomor Meja',
  body: $("#editTableModal"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let id = $(this).val();
    $.ajax(
      {
        method: "GET",
        url: "{{ route('manajemen-meja.index') }}/" + id + "/edit"
      }).done(function (response)
      {
          console.log(response);
          $("#editNumber").val(response.number);
          $("#editTableModal").attr("action", "{{ route('manajemen-meja.index') }}/" + id)
          $("#editTableModal").modal();
      }
    )     

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      type: "submit",
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});
$("#deleteTableButton").fireModal({
  title: 'Delete No. Meja',
  body: $("#deleteTableModal"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    let id = $(this).val();
    $("#deleteTableForm").attr("action", "{{ route('manajemen-meja.index') }}/" + id)
    $("#deleteTableModal").modal();     

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Hapus',
      class: 'btn btn-danger',
      type: 'submit',
      handler: function(modal) {
      }
    }
  ]
});


// kategori menu
$("#createCategoryMenuButton").fireModal({
  title: 'Tambah kategori menu',
  body: $("#createCategoryMenuForm"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)
  },
  shown: function(modal, form) {
    console.log(form)
  },

  buttons: [
    {
      type: "submit",
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {}
    }
  ]
}
);

$("#editCategoryMenuButton").fireModal({
  title: 'Input bahan',
  body: $("#editCategoryMenuForm"),
  function()
    {
      let id = $(this).val();$.ajax(
        {
          method: "GET",
          url: "{{ route('manajemen-kategori-menu.index') }}/" + id + "/edit"
        }).done(function (response)
        {
          console.log(response);
          $("#editCategory").val(response.category);
          $("#editIndex").val(response.index);
          $("#editCategoryMenuForm").attr("action", "{{ route('manajemen-kategori-menu.index') }}/" + id)
          $("#editCategoryMenuModal").modal();
        }
      )
    },
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});
// $("#editCategoryMenuButton").fireModal({
//   title: 'Edit kategori menu',
//   body: $("#editCategoryMenuForm"),
//   footerClass: 'bg-whitesmoke',
//   autoFocus: false,
//   onFormSubmit: function(modal, e, form) {
//     // Form Data
//     let id = $(this).val();
//     $.ajax(
//       {
//         method: "GET",
//         url: "{{ route('manajemen-kategori-menu.index') }}/" + id + "/edit"
//       }
//       ).done(function 
//       (response)
//       {
//         console.log(response);
//         $("#editCategory").val(response.category);
//         $("#editIndex").val(response.index);
//         $("#editCategoryMenuForm").attr("action", "{{ route('manajemen-kategori-menu.index') }}/" + id)
//         $("#editCategoryMenuForm").modal();
//       }
//       )
//   },
//   buttons: [
//     {
//       type: "submit",
//       text: 'Save',
//       submit: true,
//       class: 'btn btn-primary btn-shadow',
//       handler: function(modal) {
//       }
//     }
//   ]
// });

$("#deleteCategoryMenuButton").fireModal({
  title: 'delete kategori menu',
  body: $("#deleteCategoryMenuForm"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(this).val();
    $("#deleteCategoryMenuForm").attr("action", "{{ route('manajemen-kategori-menu.index') }}/" + id)
    $("#deleteCategoryMenuForm").modal();
  },
  buttons: [
    {
      type: "submit",
      text: 'Hapus',
      submit: true,
      class: 'btn btn-warning btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});



// add kategori kostumer
$("#add-category-costumer").fireModal({
  title: 'Tambah Kategori',
  body: $("#form-input-category-costumer"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

// add data pelanggan 
$("#add-data-costumer").fireModal({
  title: 'Tambah pelanggan',
  body: $("#form-input-data-costumer"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});


// edit data pelanggan 
$("#edit-data-costumer").fireModal({
  title: 'Edit pelanggan',
  body: $("#form-edit-data-costumer"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Save',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});





// kategori stand
$("#add-kategori-stand").fireModal({
  title: 'Input kategori stand',
  body: $("#form-input-stand"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});
// kategori order
$("#add-kategori-order").fireModal({
  title: 'Input kategori order',
  body: $("#form-input-order"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// jenis bahan
$("#add-jenis-bahan").fireModal({
  title: 'Input jenis bahan',
  body: $("#form-input-jenis-bahan"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// jenis menu
$("#add-jenis-menu").fireModal({
  title: 'Input jenis menu',
  body: $("#form-input-jenis-menu"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// manajemen resep
$("#input-data-bahan").fireModal({
  title: 'Tambah bahan',
  body: $("#form-input-data-bahan"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// bahan resep
$("#input-bahan-resep").fireModal({
  title: 'Input bahan',
  body: $("#form-input-bahan-resep"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// resep menu
$("#input-resep-menu").fireModal({
  title: 'Input bahan',
  body: $("#form-input-resep-menu"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});
// Tambah bahan
$("#update-bahan").fireModal({
  title: 'Tambah stok bahan',
  body: $("#form-update-bahan"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});
// Kurangi bahan
$("#kurangi-bahan").fireModal({
  title: 'Kurangi stok bahan',
  body: $("#form-kurangi-bahan"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});
// Detail pengeluaran
$("#detail-pengeluaran").fireModal({
  title: 'Detail pengeluaran',
  body: $("#form-detail-pengeluaran"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// harga menu
$("#input-harga-menu").fireModal({
  title: 'Input bahan',
  body: $("#form-input-harga-menu"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});

// promo
$("#input-promo").fireModal({
  title: 'Input promo',
  body: $("#form-promo"),
  buttons: [
    {
      text: 'Simpan',
      class: 'btn btn-primary btn-shadow',
      
    }
  ]
});


// $("#modal-1").fireModal({body: 'Modal body text goes here.'});
// $("#modal-2").fireModal({body: 'Modal body text goes here.', center: true});

// $("#modal-4").fireModal({
//   footerClass: 'bg-whitesmoke',
//   body: 'Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.',
//   buttons: [
//     {
//       text: 'No Action!',
//       class: 'btn btn-primary btn-shadow',
//       handler: function(modal) {
//       }
//     }
//   ]
// });






// $("#modal-6").fireModal({
//   body: '<p>Now you can see something on the left side of the footer.</p>',
//   created: function(modal) {
//     modal.find('.modal-footer').prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
//   },
//   buttons: [
//     {
//       text: 'No Action',
//       submit: true,
//       class: 'btn btn-primary btn-shadow',
//       handler: function(modal) {
//       }
//     }
//   ]
// });

// $('.oh-my-modal').fireModal({
//   title: 'My Modal',
//   body: 'This is cool plugin!'
// });