"use strict";

// Inicializimi i variablave
let sasia = 1;
const maxSasia = 10; // Kufiri maksimal i sasisë
const minSasia = 1;  // Kufiri minimal i sasisë

// Funksioni për rritjen e sasisë
function increase() {
    if (sasia < maxSasia) {
        sasia++;
        updateDisplay();
    } else {
        alert("Maximum quantity reached!");
    }
}

// Funksioni për uljen e sasisë
function decrease() {
    if (sasia > minSasia) {
        sasia--;
        updateDisplay();
    } else {
        alert("Minimum quantity is 1!");
    }
}

// Funksioni për përditësimin e ekranit
function updateDisplay() {
    const sasiaDisplay = document.getElementById("sasia");
    if (sasiaDisplay) {
        sasiaDisplay.innerText = sasia;
    } else {
        console.error("Element with ID 'sasia' not found.");
    }
}

// Funksioni për validimin e ngjyrës
function validateColor() {
    const colorSelect = document.getElementById("color");
    const selectedColor = colorSelect.value;
    if (selectedColor) {
        console.log(`Selected color: ${selectedColor}`);
    } else {
        alert("Please select a valid color.");
    }
}

// Inicializimi i Event Listeners
function initializeListeners() {
    // Event listeners për butonat e sasisë
    const decreaseButton = document.querySelector(".sasia-button:first-child");
    const increaseButton = document.querySelector(".sasia-button:last-child");

    if (decreaseButton && increaseButton) {
        decreaseButton.addEventListener("click", decrease);
        increaseButton.addEventListener("click", increase);
    } else {
        console.error("Quantity buttons not found.");
    }

    // Event listener për validimin e ngjyrës
    const colorSelect = document.getElementById("color");
    if (colorSelect) {
        colorSelect.addEventListener("change", validateColor);
    } else {
        console.error("Color selector not found.");
    }
}

// Funksioni kryesor që inicializon kodin
document.addEventListener("DOMContentLoaded", () => {
    initializeListeners();
    updateDisplay(); // Përditëson shfaqjen fillestare të sasisë
});

