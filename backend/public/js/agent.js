function showSaveButton(select) {
    // Find the parent card of the select element
    var card = select.closest('.card');
    // Find the save button within this card
    var saveBtn = card.querySelector('.save-btn');

    // If the selected value is different from the initial value, show the save button
    if (select.value !== select.getAttribute('data-initial')) {
        saveBtn.style.display = 'inline-block';
    } else {
        saveBtn.style.display = 'none';
    }
}

// Initialize the initial values for each dropdown
document.addEventListener('DOMContentLoaded', function() {
    var selects = document.querySelectorAll('select[name="assigned_to"]');
    selects.forEach(function(select) {
        select.setAttribute('data-initial', select.value);
    });
});