$(document).ready(function() {
    $('#date_aw').on('change', function () {
        let selectedPlantingId = $(this).val();

        $('#name_farm').html('<option selected value="">Pilih di sini</option>');

        if (selectedPlantingId) {
            $.ajax({
                url: "addAwAjax.php",
                type: 'POST',
                data: { id_planting: selectedPlantingId }, 
                success: function (data) {
                    $('#name_farm').append(data); 
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                    $('#name_farm').append('<option value="">Error memuat lahan</option>');
                }
            });
        } else {
            $('#name_farm').html('<option selected value="">Pilih tanggal dulu</option>');
        }
    });
});