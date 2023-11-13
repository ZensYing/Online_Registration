
$(document).ready(function() {
    // Fetch provinces
    $.ajax({
        url: 'fetch_provinces.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(index, province) {
                $('#province').append('<option value="' + province.id + '">' + province.names + '</option>');
            });
        }
    });

    // Fetch districts based on the selected province
    $('#province').on('change', function() {
        let province_id = $(this).val();
        $('#district').empty().append('<option value="">Select a district</option>');
        $('#commune').empty().append('<option value="">Select a commune</option>');

        if (province_id) {
            $.ajax({
                url: 'fetch_districts.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    province_id: province_id
                },
                success: function(data) {
                    $.each(data, function(index, district) {
                        $('#district').append('<option value="' + district.id + '">' + district.names + '</option>');
                    });
                }
            });
        }
    });

    // Fetch communes based on the selected district
    $('#district').on('change', function() {
        let district_id = $(this).val();
        $('#commune').empty().append('<option value="">Select a commune</option>');

        if (district_id) {
            $.ajax({
                url: 'fetch_communes.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    $.each(data, function(index, commune) {
                        $('#commune').append('<option value="' + commune.id + '">' + commune.names + '</option>');
                    });
                }
            });
        }
    });
});
