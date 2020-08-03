<script>
    $(function() {
        var cardTitle = $('#card_title');
        var intersectionsTable = $('#intersections_table');
        var resultsContainer = $('#search_results');
        var intersectionsCount = $('#intersection_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_intersections');
        var searchformInput = $('#intersection_search_box');
        var intersectionPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando intersecciones. Por favor espere...';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            intersectionsTable.hide();
            intersectionPagination.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td><?php echo trans("intersections.search.no-results"); ?></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-intersections')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length !== 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="intersections/' + val.id + '" data-toggle="tooltip" title="<?php echo e(trans("intersections.tooltips.show")); ?>"><?php echo trans("intersections.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="intersections/' + val.id + '/edit" data-toggle="tooltip" title="<?php echo e(trans("intersections.tooltips.edit")); ?>"><?php echo trans("intersections.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/intersections/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar Intersección" data-message="¿Está seguro que desea eliminar la intersección? ¡Eliminará con ella todas sus dependencias!">' +
                                        '<?php echo trans("intersections.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.main_st + '</td>' +
                                '<td>' + val.cross_st + '</td>' +
                                '<td class="hidden-xs">' + val.latitude + '</td>' +
                                '<td class="hidden-xs">' + val.longitude + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?> '<td>' + editCellHtml + '</td>' + <?php endif; ?>
                                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?> '<td>' + deleteCellHtml + '</td>' + <?php endif; ?>
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    }
                    intersectionsCount.html(jsonData.length + " <?php echo trans('intersections.search.found-footer'); ?>");
                    intersectionPagination.hide();
                    cardTitle.html("<?php echo trans('intersections.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    intersectionsCount.html(0 + " <?php echo trans('intersections.search.found-footer'); ?>");
                    intersectionPagination.hide();
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
            if ($('#intersection_search_box').val() !== '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                intersectionsTable.show();
                cardTitle.html("<?php echo trans('intersections.showing-all-intersections'); ?>");
                intersectionPagination.show();
                intersectionsCount.html(" ");
            }
        });

        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            intersectionsTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('intersections.showing-all-intersections'); ?>");
            intersectionPagination.show();
            intersectionsCount.html(" ");
        });
    });
</script>
<?php /**PATH /home/atmeccom/resources/views/scripts/search-intersections.blade.php ENDPATH**/ ?>