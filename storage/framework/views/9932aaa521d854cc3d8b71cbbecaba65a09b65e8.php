<script>
    $(function() {
        var cardTitle = $('#card_title');
        var regulatorboxesTable = $('#regulator_boxes_table');
        var resultsContainer = $('#search_results');
        var regulatorboxesCount = $('#regulator_boxes_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_regulator_boxes');
        var searchformInput = $('#regulator_search_box');
        var regulatorboxesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando reguladores de tráfico. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            regulatorboxesTable.hide();
            regulatorboxesPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("traffic-tensors.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-regulator-boxes')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="regulator-boxes/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("regulator-boxes.tooltips.show")); ?>"><?php echo trans("regulator-boxes.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="regulator-boxes/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("regulator-boxes.tooltips.edit")); ?>"><?php echo trans("regulator-boxes.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/regulator-boxes/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar caja reguladora" data-message="¿Está seguro que desea eliminar esta caja reguladora? ¡Eliminará con ella todas sus dependencias!">' +
                                        '<?php echo trans("regulator-boxes.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.main_st + ' y ' + val.cross_st + '</td>' +
                                '<td class="hidden-xs">' + val.brand + '</td>' +
                                '<td class="hidden-xs">' + val.state + '</td>' +
                                '<td class="hidden-xs">' + val.google_address + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?> '<td>' + editCellHtml + '</td>' + <?php endif; ?>
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    regulatorboxesCount.html(jsonData.length + " <?php echo trans('regulator-boxes.search.found-footer'); ?>");
                    regulatorboxesPagination.hide();
                    cardTitle.html("<?php echo trans('regulator-boxes.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    regulatorboxesCount.html(0 + " <?php echo trans('regulator-boxes.search.found-footer'); ?>");
                    regulatorboxesPagination.hide();
                    cardTitle.html("<?php echo trans('regulator-boxes.search.title'); ?>");
                    searchformInput.prop("readonly", false);
                }
            });
        });

        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });

        searchformInput.keyup(function(event) {
            if ($('#regulator_search_boxregulator_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                regulatorboxesTable.show();
                cardTitle.html("<?php echo trans('regulator-boxes.showing-all-regulator-boxes'); ?>");
                regulatorboxesPagination.show();
                regulatorboxesCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            regulatorboxesTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('regulator-boxes.showing-all-regulator-boxes'); ?>");
            regulatorboxesPagination.show();
            regulatorboxesCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmeccom/resources/views/scripts/search-regulator-boxes.blade.php ENDPATH**/ ?>