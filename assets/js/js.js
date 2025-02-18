//date-picker
// Populate year dropdown dynamically
function populateYears(selectId) {
    const yearSelect = document.getElementById(selectId);
    const currentYear = new Date().getFullYear();
    for (let i = currentYear; i >= currentYear - 100; i--) {
        let option = document.createElement("option");
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
    }
}

populateYears("year1");
populateYears("year2");

// Function to update days based on selected month & year (Leap year support)
function updateDays() {
    const month = document.getElementById("month2").value;
    const year = document.getElementById("year2").value;
    const daySelect = document.getElementById("day");

    const daysInMonth = new Date(year, month, 0).getDate(); // Get last day of selected month
    daySelect.innerHTML = ""; // Clear previous options

    for (let i = 1; i <= daysInMonth; i++) {
        let option = document.createElement("option");
        option.value = i < 10 ? "0" + i : i;
        option.textContent = i;
        daySelect.appendChild(option);
    }
}

updateDays(); // Initialize days dropdown

// Function to toggle visibility of pickers
function togglePicker(id) {
    document.getElementById("pickerYearMonth").style.display = "none";
    document.getElementById("pickerFullDate").style.display = "none";

    const picker = document.getElementById(id);
    picker.style.display = picker.style.display === "none" ? "block" : "none";
}

// Function to get selected date
function getSelectedDate(yearId, monthId, outputId, dayId = null, status) {
    const year = document.getElementById(yearId).value;
    const month = document.getElementById(monthId).value;
    let dateText = `${year}-${month}`;

    if (dayId) {
        const day = document.getElementById(dayId).value;
        dateText += `-${day}`;
    }

    const pickerContainer = document.querySelectorAll(".picker-container")

    pickerContainer.forEach(container => {
        container.style.display = "none"
    });

    if (status == 'daily') {
        fetchDataDaily(dateText);
    } else {
        fetchDataMonthly(dateText);
    }

    // Fetch and update data based on the selected date/month

}

// Hide popups when clicking outside
document.addEventListener("click", function (event) {
    const pickers = document.querySelectorAll(".picker-container");
    const buttons = document.querySelectorAll(".toggle-btn");

    let isInsidePicker = Array.from(pickers).some(picker => picker.contains(event.target));
    let isButton = Array.from(buttons).some(button => button.contains(event.target));

    if (!isInsidePicker && !isButton) {
        pickers.forEach(picker => picker.style.display = "none");
    }
});
//