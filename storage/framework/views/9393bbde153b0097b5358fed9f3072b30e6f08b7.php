<script>
    $(function() {
        var cardTitle = $('#card_title');
        var trafficpolesTable = $('#traffic_poles_table');
        var resultsContainer = $('#search_results');
        var trafficpolesCount = $('#traffic_poles_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_traffic_poles');
        var searchformInput = $('#traffic_pole_search_box');
        var trafficpolesPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando<span class="hidden-xs"> postes de tráfico. Por favor espere...</span>';

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
                                '<td><?php echo trans("traffic-poles.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-traffic-poles')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="traffic-poles/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("traffic-poles.tooltips.show")); ?>"><?php echo trans("traffic-poles.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="traffic-poles/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("traffic-poles.tooltips.edit")); ?>"><?php echo trans("traffic-poles.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/traffic-poles/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar poste" data-message="¿Está seguro que desea eliminar el poste? ¡Eliminará con el todas sus dependencias!">' +
                                        '<?php echo trans("traffic-poles.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.intersection.main_st + ' y ' + val.intersection.cross_st + '</td>' +
                                '<td>' + val.height + 'm</td>' +
                                '<td class="hidden-xs">' + val.state + '</td>' +
                                '<td class="hidden-xs">' + val.material + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?> '<td>' + editCellHtml + '</td>' + <?php endif; ?>
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    trafficpolesCount.html(jsonData.length + " <?php echo trans('traffic-poles.search.found-footer'); ?>");
                    intersectionPagination.hide();
                    cardTitle.html("<?php echo trans('traffic-poles.search.title'); ?>");
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
            if ($('#traffic_pole_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                trafficpolesTable.show();
                cardTitle.html("<?php echo trans('traffic-poles.showing-all-traffic-poles'); ?>");
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
            cardTitle.html("<?php echo trans('traffic-poles.showing-all-traffic-poles'); ?>");
            trafficpolesPagination.show();
            trafficpolesCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmdeveqadoor/resources/views/scripts/search-traffic-poles.blade.php ENDPATH**/ ?>