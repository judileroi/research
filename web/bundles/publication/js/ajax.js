/**
 * Created by El-Mobizy on 8/26/2016.
 */


var ajax = {

    addgroupeOperation: function () {
        var GOlibelle = $('#gO').val();
        $.ajax({
            type: "POST",
            url: Routing.generate("admin_ajax_new_groupeOperation"),
            data: {GOlibelle: GOlibelle},
            success: function (data) {
                //alert(data);
                if (data === 'exist') {
                    $("#close").trigger('click');
                    $("#exist").html('Xa existe deja');

                } else {
                    var option = new Option(data, data);
                    $('.natureoperation_groupeOperationid').append($(option));
                    $("#close").trigger('click');

                }
                $("#into").text(data);
                // $("#newValselect").append($('<option>', {
                //     value: $(this).val(),
                //     text : $(this).text(data)
                // })),

            }
        });
    },

    remplirTableFrais: function () {
        var typeFrais = $('#frais_catalogfrais :selected').text();
        var idNature = $('#idNature').val();
        // alert(typeFrais);
        $.ajax({
            type: "POST",
            url: Routing.generate("admin_ajax_remplir_table_frais"),
            data: {
                typeFrais: typeFrais,
                idNature: idNature,
            },
            success: function (data) {
                $('#tranche').css('display', 'block');
                $('#remplir').html(data);
            }
        });

    },


    // Ajax code for partner search

    // Ajax code for partner search
    partenaireQuery: function () {

        var query = $("input[type='radio'][name='query']:checked").val();
        var search = $('#searchInput').val();

//|| search === undefined
        if ( query == 'undefined' || query == null  || search == null ||  search == '' ) {
           // alert( 'search zero');
            $('#empty').css('display', 'block').fadeOut(5000);
            //  $('.error').show();
        } else {

           // $('#modal_code').attr('style', 'display: none');
            $('.loading').attr('style', 'display: block');
            // alert( search);   admin_ajax_partenaireSearch
            // alert( search);
            $.ajax({
                type: "POST",
                // url: "http://127.0.0.1/Git/owomi-back/web/app_dev.php/search_result",
                url: Routing.generate('admin_ajax_partenaireSearch'),
                cache: false,
                data: {
                    query: query,
                    search: search
                },
                success: function (response) {
                    //alert(search);
                //  $('.loading').attr('style', 'display: block');
                   $('#modal_code').attr('style', 'display: none');
                    $('#result').html(response);
                    //alert(response);

                }
            });
        }

    }
};

