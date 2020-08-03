<script>
    $(function() {
        var cardTitle = $('#card_title');
        var traffictensorsTable = $('#traffic_tensors_table');
        var resultsContainer = $('#search_results');
        var traffictensorsCount = $('#traffic_tensors_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_traffic_tensors');
        var searchformInput = $('#traffic_tensor_search_box');
        var traffictensorsPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando<span class="hidden-xs"> tensores de tráfico. Por favor espere...</span>';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            traffictensorsTable.hide();
            traffictensorsPagination.hide();
            clearSearchTrigger.show();

            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("traffic-tensors.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-traffic-tensors')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="traffic-tensors/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("traffic-tensors.tooltips.show")); ?>"><?php echo trans("traffic-tensors.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="traffic-tensors/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("traffic-tensors.tooltips.edit")); ?>"><?php echo trans("traffic-tensors.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/traffic-tensors/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar tensor" data-message="¿Está seguro que desea eliminar el tensor? ¡Eliminará con el todas sus dependencias!">' +
                                        '<?php echo trans("traffic-tensors.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.height + '</td>' +
                                '<td class="hidden-xs">' + val.material + '</td>' +
                                '<td class="hidden-xs">' + val.comment + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?> '<td>' + editCellHtml + '</td>' + <?php endif; ?>
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    traffictensorsCount.html(jsonData.length + " <?php echo trans('traffic-tensors.search.found-footer'); ?>");
                    intersectionPagination.hide();
                    cardTitle.html("<?php echo trans('traffic-tensors.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    traffictensorsCount.html(0 + " <?php echo trans('intersections.search.found-footer'); ?>");
                    traffictensorsPagination.hide();
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
            if ($('#traffic_tensor_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                traffictensorsTable.show();
                cardTitle.html("<?php echo trans('traffic-tensors.showing-all-traffic-tensors'); ?>");
                traffictensorsPagination.show();
                traffictensorsCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            traffictensorsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('traffic-tensors.showing-all-traffic-tensors'); ?>");
            traffictensorsPagination.show();
            traffictensorsCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmdeveqadoor/resources/views/scripts/search-traffic-tensors.blade.php ENDPATH**/ ?>