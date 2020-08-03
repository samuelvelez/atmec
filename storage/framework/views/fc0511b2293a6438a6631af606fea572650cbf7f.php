<script>
    $(function() {
        var cardTitle = $('#card_title');
        var vsignalsTable = $('#inventory_table');
        var resultsContainer = $('#search_results');
        var vsignalsCount = $('#inventory_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_vsignal');
        var searchformInput = $('#vsignal_search_box');
        var vsignalPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando<span class="hidden-xs">  tipo de señal. Por favor espere...</span>';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            vsignalsTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("signalsinventory.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-signals-inventory')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="signals-inventory/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("signalsinventory.tooltips.show")); ?>"><?php echo trans("signalsinventory.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="signals-inventory/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("signalsinventory.tooltips.edit")); ?>"><?php echo trans("signalsinventory.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/signals-inventory/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar tipo de señal" data-message="¿Está seguro que desea eliminar esta señal? ¡Eliminará con ella todas sus dependencias!">' +
                                        '<?php echo trans("signalsinventory.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + val.group + '</td>' +
                                '<td>' + val.subgroup + '</td>' +
                                '<td>' + val.variations + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmoperator')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    };
                    vsignalsCount.html(jsonData.length + " <?php echo trans('signalsinventory.search.found-footer'); ?>");
                    vsignalPagination.hide();
                    cardTitle.html("<?php echo trans('signalsinventory.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    vsignalsCount.html(0 + " <?php echo trans('intersections.search.found-footer'); ?>");
                    vsignalPagination.hide();
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
            if ($('#vsignal_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                vsignalsTable.show();
                cardTitle.html("<?php echo trans('signalsinventory.showing-all-signals-inventories'); ?>");
                vsignalPagination.show();
                vsignalsCount.html(" ");
            };
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            vsignalsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('signalsinventory.showing-all-signals-inventories'); ?>");
            vsignalPagination.show();
            vsignalsCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmdeveqadoor/resources/views/scripts/search-signals-inventory.blade.php ENDPATH**/ ?>