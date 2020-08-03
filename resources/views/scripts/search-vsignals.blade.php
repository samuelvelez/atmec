<script>
    $(function() {
        var cardTitle = $('#card_title');
        var vsignalsTable = $('#vsignals_table');
        var resultsContainer = $('#search_results');
        var vsignalsCount = $('#vsignal_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_vsignals');
        var searchformInput = $('#vsignal_search_box');
        var vsignalPagination = $('.pagination');
        var searchSubmit = $('#search_trigger');

        let searching = '<i class="fa fa-spinner fa-spin"></i> Buscando<span class="hidden-xs">  señales verticales. Por favor espere...</span>';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html(searching);
            vsignalsTable.hide();
            searchformInput.prop("readonly", true);
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("verticalsignals.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-vertical-signals') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        resultsContainer.html('');
                        $.each(jsonData, function(index, val) {
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="vertical-signals/' + val.id + '" data-toggle="tooltip" title="{{ trans("verticalsignals.tooltips.show") }}">{!! trans("verticalsignals.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="vertical-signals/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("verticalsignals.tooltips.edit") }}">{!! trans("verticalsignals.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/vertical-signals/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Eliminar señal vertical" data-message="¿Está seguro que desea eliminar esta señal? ¡Eliminará con ella todas sus dependencias!">' +
                                        '{!! trans("verticalsignals.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.code + '</td>' +
                                '<td>' + val.creator + '</td>' +
                                '<td>' + val.state + '</td>' +
                                '<td>' + val.fastener + '</td>' +
                                '<td>' + val.material + '</td>' +
                                '<td>' + val.normative + '</td>' +
                                '<td>' + val.google_address + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                @role('atmadmin|atmcollector') '<td>' + editCellHtml + '</td>' + @endrole
                                @role('atmadmin') '<td>' + deleteCellHtml + '</td>' + @endrole
                            '</tr>');
                        });
                    } else {
                        resultsContainer.html(noResulsHtml);
                    };
                    vsignalsCount.html(jsonData.length + " {!! trans('verticalsignals.search.found-footer') !!}");
                    vsignalPagination.hide();
                    cardTitle.html("{!! trans('verticalsignals.search.title') !!}");
                    searchformInput.prop("readonly", false);
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.html(noResulsHtml);
                    }
                    else if (response.status === 500) {
                        resultsContainer.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                    }

                    vsignalsCount.html(0 + " {!! trans('intersections.search.found-footer') !!}");
                    vsignalPagination.hide();
                    cardTitle.html("{!! trans('intersections.search.title') !!}");
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
                cardTitle.html("{!! trans('verticalsignals.showing-all-vsignals') !!}");
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
            cardTitle.html("{!! trans('verticalsignals.showing-all-vsignals') !!}");
            vsignalPagination.show();
            vsignalsCount.html(" ");
        });
    });
</script>
