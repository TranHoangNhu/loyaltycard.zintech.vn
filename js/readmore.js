$(document).ready(function () {
  $(".btn-dark").on("click", function () {
    $(this).parent().find(".extraInfo").toggleClass("active");
    const btnMoreLess = $(this).parent().find(".extraInfo").hasClass("active")
      ? " Ẩn chi tiết"
      : "Chi tiết";
    $(this).text(btnMoreLess);
  });
});