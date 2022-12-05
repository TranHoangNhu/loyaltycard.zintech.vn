const btnReadMore = document.querySelectorAll(".infoProd button");
const dataMoreLess = document.querySelectorAll(".infoProd .extraInfo");
for (i = 0; i < btnReadMore.length; i++) {
  btnReadMore[i].onclick = function () {
    for (j = 0; j < dataMoreLess.length; j++)
    //   dataMoreLess[j].style.transition = "all 0.5s";
    dataMoreLess[j].style.height = "auto";
  };
}
