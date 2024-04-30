var imgFile = document.querySelectorAll(".input-image");
var imgTag = document.querySelectorAll(".img-field");
var colorField = document.querySelectorAll(".input-color");
var checkColor = document.querySelectorAll(".color-check");
var submit = document.querySelector(".submit-add");

if(submit != null){
  submit.disabled = true;
  submit.classList.add('disabled');
}

colorField.forEach((item, key) => {
  item.oninput = (e) => {
    let value = e.target.value.trim('#');

    checkColor[key].style.backgroundColor = '#'+value;
    checkColor[key].style.border= '1px solid grey';

    if(submit != null){
      if (checkColor[key].style.backgroundColor != null) {
        submit.disabled = false;
        submit.classList.remove('disabled');
      } else {
        submit.disabled = true;
        submit.classList.add('disabled');
      }
    }
  };
});

imgFile.forEach((item, key) => {
  item.onchange = function (e) {
    for (var i = 0; e.target.files[i]; i++) {
      const reader = new FileReader();

      reader.readAsDataURL(e.target.files[i]);

      reader.onload = (e) => {
        imgTag[key].src = e.target.result;
      };
    }

    imgTag[key].style.border = "2px solid #80bdff";

    imgTag[key].style.boxShadow = " 0 0 0 0.2rem rgba(0,123,255,.25)";

    imgTag.required = "true";

    colorField[key].required = "true";
  };
});


