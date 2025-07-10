$(document).ready(function() {
    
    // // --- START: โค้ดส่วนที่แก้ไข ---
    // // ตรวจสอบก่อนว่ามีตาราง #myRequestsTable อยู่ในหน้าเว็บหรือไม่
    // if ($('#myRequestsTable').length) { 
    //     // ถ้ามีตารางอยู่จริง ถึงจะสั่งให้ DataTables ทำงาน
    //     $('#myRequestsTable').DataTable({
    //         "language": {
    //             "url": "../js/i18n/Thai.json"
    //         },
    //         "order": [[ 0, "desc" ]],
    //         "destroy": true
    //     });
    // }
    // // --- END: โค้ดส่วนที่แก้ไข ---

    // Handle asset selection to populate fields
    $('#asset_id').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        $('#asset_name_display').val(selectedOption.data('asset-name'));
        $('#asset_model_display').val(selectedOption.data('model'));
        $('#asset_serial_no_display').val(selectedOption.data('serial-no'));
        $('#asset_brand_display').val(selectedOption.data('brand'));
    });
    $('#asset_id').trigger('change');

    // Show/hide 'Other' text input based on dropdown selection
    $('#request_type_id').on('change', function() {
        if ($(this).val() === '0') {
            $('#other_request_type_detail_field').show();
            $('#other_request_type_detail').prop('required', true);
        } else {
            $('#other_request_type_detail_field').hide();
            $('#other_request_type_detail').prop('required', false);
            $('#other_request_type_detail').val('');
        }
    });
    $('#request_type_id').trigger('change');
});