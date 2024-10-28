
/* PROGRESS WITH STEPS */

const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

function areFieldsFilled() {
  const currentStep = formSteps[formStepsNum];
  const inputs = currentStep.querySelectorAll("input[required], textarea[required], select[required]");
  return Array.from(inputs).every(input => input.value.trim() !== "");
}

function updateFormSteps() {
  formSteps.forEach((formStep, index) => {
    formStep.classList.toggle("form-step-active", index === formStepsNum);
  });
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    progressStep.classList.toggle("progress-step-active", idx < formStepsNum + 1);
  });

  const progressActive = document.querySelectorAll(".progress-step-active");
  progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (areFieldsFilled()) {
      formStepsNum++;
      updateFormSteps();
      updateProgressbar();
    } else {
      alert("Please fill in all required fields before proceeding.");
    }
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (formStepsNum > 0) {
      formStepsNum--;
      updateFormSteps();
      updateProgressbar();
    }
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("form-step-active") &&
      formStep.classList.remove("form-step-active");
  });

  formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

function toggleDropdown() {
  const dropdown = document.getElementById("dropdownMenu");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

window.onclick = function(event) {
  if (!event.target.matches('.dropdown a img') && !event.target.matches('.dropdown a')) {
    const dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      const openDropdown = dropdowns[i];
      if (openDropdown.style.display === "block") {
        openDropdown.style.display = "none";
      }
    }
  }
}
