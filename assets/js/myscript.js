const flashData = $(".flash-data").data("flashdata");

if (flashData) {
  Swal({
    title: "Success Message",
    text: "Success " + flashData,
    type: "success",
  });
}

// tombol-hapus
$(".tombol-hapus").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal({
    title: "Are You Sure",
    text: "Drawing Will Be Delete",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

//tombol approve
$(".approveMP").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal({
    title: "Are You Sure",
    text: "Technical Sheet Approved MP",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Approved",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

//tombol approve
$(".approveQP").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal({
    title: "Are You Sure",
    text: "Technical Sheet Approved QP",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Approved",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

//tombol approve user
$(".approve").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal({
    title: "Are You Sure",
    text: "Activation user",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Approved",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

// tombol-hapus-user
$(".remove-user").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal({
    title: "Are You Sure",
    text: "This user will be delete ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});
