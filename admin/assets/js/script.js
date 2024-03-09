const forms = document.querySelector(".forms");
const passHideShow = document.querySelectorAll(".hide_icone");
const links = document.querySelectorAll(".link");

passHideShow.forEach(showIcon => {
  showIcon.addEventListener("click", () => {
    let pass = showIcon.parentElement.parentElement.querySelectorAll(".password");

    pass.forEach(password => {
      if(password.type === "password"){
        password.type = "text";
        showIcon.classList.replace("bx-hide", "bx-show");
        return;
      }else{
        password.type = "password";
        showIcon.classList.replace("bx-show","bx-hide");
      }
    });
  });
});
