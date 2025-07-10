/**
 * Initializes a DataTable and sets up a confirmation modal for delete actions.
 * @param {string} tableId - The ID of the table to apply DataTable to (e.g., '#employeesTable').
 * @param {string} deleteModalId - The ID of the delete confirmation modal (e.g., '#deleteEmployeeModal').
 * @param {string} deleteActionUrl - The base URL for the delete action (e.g., 'delete_employee.php').
 */
function initializeDataTableWithDeleteModal(tableId, deleteModalId, deleteActionUrl) {
    // Initialize DataTable with Thai language settings
    $(tableId).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/th.json"
        }
    });

    // Set up the event listener for the delete confirmation modal
    $(deleteModalId).on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = $(event.relatedTarget);
        
        // Extract info from data-id attributes
        var id = button.data('id');
        
        // Find the confirm delete button in the modal and set its href
        var modal = $(this);
        modal.find('.btn-danger').attr('href', deleteActionUrl + '?id=' + id);
    });
}


/**
 * Overloads the function for manage_positions.php which uses a different URL structure
 * @param {string} tableId 
 * @param {string} deleteModalId 
 * @param {string} deleteActionUrl 
 */
function initializePositionDataTable(tableId, deleteModalId, deleteActionUrl) {
    // Initialize DataTable with Thai language settings
    $(tableId).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/th.json"
        }
    });

    // Set up the event listener for the delete confirmation modal
    $(deleteModalId).on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        // Note the different URL structure with "?action=delete&id="
        modal.find('.btn-danger').attr('href', deleteActionUrl + '?action=delete&id=' + id);
    });
}