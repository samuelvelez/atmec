<script>
    $(function() {
        var cardTitle = $('#card_title');
        var trafficpolesTable = $('#regulator_devices_table');
        var resultsContainer = $('#search_results');
        var trafficpolesCount = $('#regulator_devices_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_regulator_devices');
        var searchformInput = $('#regulator_device_search_box');
        var trafficpolesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando dispositivos de cajas reguladoras. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            trafficpolesTable.hide();
            trafficpolesPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("regulator-devices.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td> </td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-regulator-devices')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="regulator-devices/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("regulator-devices.tooltips.show")); ?>"><?php echo trans("regulator-devices.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="regulator-devices/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("regulator-devices.tooltips.edit")); ?>"><?php echo trans("regulator-devices.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/regulator-devices/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar poste" data-message="¿Está seguro que desea eliminar el poste? ¡Eliminará con el todas sus dependencias!">' +
                                        '<?php echo trans("regulator-devices.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            let badge = '';
                            let type_label = '';

                            switch (val.type) {
                                case 'ups_brands':
                                    type_label = 'UPS';
                                    badge = 'info';
                                    break;
                                case 'energy_brands':
                                    type_label = 'Fuente de poder';
                                    badge = 'danger';
                                    break;
                                case 'mmu_brands':
                                    type_label = 'MMU';
                                    badge = 'primary';
                                    break;
                                case 'travel_brands':
                                    type_label = 'Velocidad de viaje';
                                    badge = 'success';
                                    break;
                                case 'controller_brands':
                                    type_label = 'Controlador';
                                    badge = 'warning';
                                    break;
                            }

                            let val_type = '<span class="badge-pill badge badge-' + badge + '">' + type_label + '</span>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.rb_code + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val_type + '</td>' +
                                '<td class="hidden-xs">' + val.brand + '</td>' +
                                '<td class="hidden-xs">' + val.model + '</td>' +
                                '<td class="hidden-xs">' + val.erp_code + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?> '<td>' + editCellHtml + '</td>' + <?php endif; ?>
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    trafficpolesCount.html(jsonData.length + " <?php echo trans('regulator-devices.search.found-footer'); ?>");
                    intersectionPagination.hide();
                    cardTitle.html("<?php echo trans('regulator-devices.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    trafficpolesCount.html(0 + " <?php echo trans('intersections.search.found-footer'); ?>");
                    trafficpolesPagination.hide();
                    cardTitle.html("<?php echo trans('intersections.search.title'); ?>");
                    searchformInput.prop("readonly", false);
                }
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#regulator_device_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                trafficpolesTable.show();
                cardTitle.html("<?php echo trans('regulator-devices.showing-all-regulator-devices'); ?>");
                trafficpolesPagination.show();
                trafficpolesCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            trafficpolesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('regulator-devices.showing-all-regulator-devices'); ?>");
            trafficpolesPagination.show();
            trafficpolesCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmeccom/resources/views/scripts/search-regulator-devices.blade.php ENDPATH**/ ?>