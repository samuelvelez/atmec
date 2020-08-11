<script>
    $(function() {
        var cardTitle = $('#card_title');
        var devicesTable = $('#inventory_table');
        var resultsContainer = $('#search_results');
        var devicesCount = $('#inventory_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_device');
        var searchformInput = $('#device_search_box');
        var devicesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando dispositivos de tráfico. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            devicesPagination.hide();
            devicesTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("device-inventory.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-device-inventory')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="devices-inventory/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("device-inventory.tooltips.show")); ?>"><?php echo trans("device-inventory.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="devices-inventory/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("device-inventory.tooltips.edit")); ?>"><?php echo trans("device-inventory.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/devices-inventory/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar dispositivo" data-message="¿Está seguro que desea eliminar este dispositivo?  ¡Eliminará con el todas sus dependencias!">' +
                                        '<?php echo trans("device-inventory.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';
                            let dimensions = val.dimensions == null ? '' : val.dimensions;
                            let erp_code = val.erp_code == null ? '' : val.erp_code;
                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + dimensions + '</td>' +
                                '<td>' + erp_code + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmoperator')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    };
                    devicesCount.html(jsonData.length + " <?php echo trans('device-inventory.search.found-footer'); ?>");
                    devicesPagination.hide();
                    cardTitle.html("<?php echo trans('device-inventory.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    devicesCount.html(0 + " <?php echo trans('device-inventory.search.found-footer'); ?>");
                    devicesPagination.hide();
                    cardTitle.html("<?php echo trans('device-inventory.search.title'); ?>");
                    searchformInput.prop("readonly", false);
                }
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#device_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                devicesTable.show();
                cardTitle.html("<?php echo trans('device-inventory.showing-all-signals-inventories'); ?>");
                devicesPagination.show();
                devicesCount.html(" ");
            };
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            devicesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('device-inventory.showing-all-signals-inventories'); ?>");
            devicesPagination.show();
            devicesCount.html(" ");
        });
    });
</script>
<?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/scripts/search-devices-inventory.blade.php ENDPATH**/ ?>