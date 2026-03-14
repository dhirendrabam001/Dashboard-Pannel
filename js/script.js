const select = document.getElementById("dateSelect");
const realDate = document.getElementById("realDate");

select.addEventListener("click", function () {
  realDate.showPicker();
});

realDate.addEventListener("change", function () {
  select.options[0].text = this.value;
});
