import '../css/register.css';

// Get all the step cards and buttons
const stepCards = document.querySelectorAll('.step');
const nextButtons = document.querySelectorAll('.btn-outline-dark');

let currentStep = 0;

// Show the first step initially
stepCards[currentStep].style.display = 'block';
stepCards[1].style.display = 'none';
stepCards[2].style.display = 'none';
stepCards[3].style.display = 'none';
stepCards[4].style.display = 'none';

// Function to go to the next step
function nextStep() {
    if (currentStep >= 0 && currentStep <= 3) {
        stepCards[currentStep].style.display = 'none';
        currentStep++;
        stepCards[currentStep].style.display = 'block';
    }
}

// // Function to go to the previous step
// function previousStep() {
//     if (currentStep >= 0 && currentStep <= 3) {
//         stepCards[currentStep].style.display = 'none';
//         currentStep--;
//         stepCards[currentStep].style.display = 'block';
//     }
// }

// Add event listeners to all Next buttons
nextButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        nextStep();
    });
});

// // Add event listeners to all Previous buttons
// nextButtons.forEach(button => {
//     button.addEventListener('click', function (event) {
//         event.preventDefault();
//         previousStep();
//     });
// });