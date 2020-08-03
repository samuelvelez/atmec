<script>
    $(function () {
        $('thead').hide();

        let config = Array();
        config['vsignal-filters'] = {
            url: "{{ route('vsignal-filters') }}",
            no_result: '<tr>' +
                '<td>{!! trans("signalsinventory.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#signals_heading',
            result_caption: ' señales encontradas',
            render: function (container, data) {
                $.each(data, function (index, val) {
                    container.append('<tr>' +
                        '<td>' + val.code + '</td>' +
                        '<td>' + val.latitude + '</td>' +
                        '<td>' + val.longitude + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.fastener + '</td>' +
                        '<td>' + val.material + '</td>' +
                        '<td>' + val.parish + '</td>' +
                        '<td>' + val.neighborhood + '</td>' +
                        '<td>' + val.google_address + '</td>' +
                        '</tr>');

                    add_signal_marker(val);
                });
            },
            excel_export: '{{ url('/georeports/signals-excel/') }}',
        };
        config['light-filters'] = {
            url: '{{ route('light-filters') }}',
            no_result: '<tr>' +
                '<td>{!! trans("traffic-lights.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#lights_heading',
            result_caption: ' semáforos encontrados',
            render: function (container, data) {
                $.each(data, function (index, val) {
                    container.append('<tr>' +
                        '<td>' + val.id + '</td>' +
                        '<td>' + val.brand + '</td>' +
                        '<td>' + val.fastener + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.orientation + '</td>' +
                        '<td>' + val.intersection + '</td>' +
                        '</tr>');

                    add_light_marker(val);
                });
            },
            excel_export: '{{ url('/georeports/lights-excel/') }}',
        };
        config['regulator-filters'] = {
            url: '{{ route('regulator-filters') }}',
            no_result: '<tr>' +
                '<td>{!! trans("traffic-lights.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#regulators_heading',
            result_caption: ' reguladoras encontradas',
            render: function (container, data) {
                $.each(data, function (index, val) {
                    container.append('<tr>' +
                        '<td>' + val.id + '</td>' +
                        '<td>' + val.code + '</td>' +
                        '<td>' + val.erp_code + '</td>' +
                        '<td>' + val.brand + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.intersection + '</td>' +
                        '</tr>');

                    add_regulator_marker(val);
                });
            },
            excel_export: '{{ route('regulators-excel') }}',
        };

        let filter_form = $('.tab-pane.show form');
        let filter_submit = $('#filter-submit');
        let filter_reset = $('#filter-reset');
        let result_container = $('#result_table');
        let result_caption = $('#result_caption');

        let markers_list = [];
        let bounds = new google.maps.LatLngBounds();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        filter_submit.click(function (event) {
            event.preventDefault();
            clear_data();

            // Get current form id
            filter_form = $('.tab-pane.show form');
            let form_id = filter_form.attr('id');

            $("#excel-form").attr('action', config[form_id].excel_export);

            // Serialize form params
            let params = filter_form.serialize();
            $('#excel_criteria').val(params);

            result_container.html('<i class="fa fa-spinner fa-spin"></i> Buscando. Por favor espere...');

            disable_selectizes();
            Pace.track(function() {
                $.ajax({
                    type: 'POST',
                    url: config[form_id].url,
                    data: params,
                    async: true,
                    success: function (result) {
                        let jsonData = JSON.parse(result);
                        clear_data();

                        if (jsonData.length !== 0) {
                            result_caption.html(jsonData.length + config[form_id].result_caption);
                            config[form_id].render(result_container, jsonData);
                            map.fitBounds(bounds);

                            $('#excel-export').attr("disabled", false);
                            $('#save-image-btn').attr("disabled", false);
                        } else {
                            result_container.append(config[form_id].no_result);
                        }

                        $(config[form_id].result_heading).show();
                    },
                    error: function (response, status, error) {
                        $(config[form_id].result_heading).show();

                        if (response.status === 422) {
                            result_container.html(config[form_id].no_result);
                        } else if (response.status === 500) {
                            result_container.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                        }
                    },
                });
            });
            enable_selectizes();
        });

        clear_data = function () {
            // clear result_container
            result_container.html('');
            result_caption.html('');
            $('table thead').hide();

            // clear map markers
            for (let i = 0; i < markers_list.length; i++) {
                markers_list[i].setMap(null);
            }

            markers_list = [];
            bounds = new google.maps.LatLngBounds();

            $('#excel-export').attr("disabled", true);
            $('#save-image-btn').attr("disabled", true);
        };

        add_signal_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: val.code,
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture + '" alt="' + val.code + '" title="' + val.code + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Señal: ' + val.code + '</h4>\
                    <p class="card-text">\
                    <p><strong>Dirección: </strong>' + val.google_address + '</p>\
                    <p><strong>Comentario: </strong>' + val.comment + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('retornarAlerts/') }}';
                $('#modal-select-vsignal').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Señal vertical: ' + val.code);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#signal-picture').attr('src', val.picture);
                    $(this).find('#signal-picture').css('background-image', 'url(' + val.picture + ')');
                    $(this).find('#signal-code').text(val.code);
                    $(this).find('#signal-group').text(val.group);
                    $(this).find('#signal-subgroup').text(val.subgroup);
                    $(this).find('#signal-lat').text(val.latitude);
                    $(this).find('#signal-lng').text(val.longitude);
                    $(this).find('#signal-address').text(val.google_address);
                    $(this).find('#signal-parish').text(val.parish);
                    $(this).find('#signal-neighborhood').text(val.neighborhood);
                    $(this).find('#signal-state').text(val.state);
                    $(this).find('#signal-material').text(val.material);
                    $(this).find('#signal-fastener').text(val.fastener);
                    $(this).find('#signal-comment').text(val.comment);

                    $(this).find('#anchor_view').attr("href", "retornarAlerts/" + 'S/' + val.id + '/' + val.code);
                    $(this).find('#anchor_edit').attr("href", "/vertical-signals/" + val.id + "/edit");
                });

                $('#modal-select-vsignal').modal('show');
            });

            markers_list.push(marker);
        }

        add_light_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: String(val.id),
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture + '" alt="' + val.id + '" title="' + val.id + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Semáforo: ' + val.id + '</h4>\
                    <p class="card-text">\
                    <p><strong>Fabricante: </strong>' + val.brand + '</p>\
                    <p><strong>Estado: </strong>' + val.state + '</p>\
                    <p><strong>Orientación: </strong>' + val.orientation + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('traffic-lights/') }}' + '/' + val.id;
                var code = '0';
                $('#modal-select-light').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Semáforo: ' + val.id);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#light-picture').attr('src', val.picture);
                    $(this).find('#light-picture').css('background-image', 'url(' + val.picture + ')');
                    $(this).find('#light-id').text(val.id);
                    $(this).find('#light-code').text(val.code);
                    $(this).find('#light-intersection').text(val.intersection);
                    $(this).find('#light-tensor').text(val.tensor);
                    $(this).find('#light-pole').text(val.pole);
                    $(this).find('#light-regulator').text(val.regulator);
                    $(this).find('#light-brand').text(val.brand);
                    $(this).find('#light-model').text(val.model);
                    $(this).find('#light-state').text(val.state);
                    $(this).find('#light-fastener').text(val.fastener);
                    $(this).find('#light-comment').text(val.comment);
                    
                    if (val.code == ''){
                        code = '0'
                    }else{
                        code = val.code
                    }    
                    $(this).find('#anchor_view').attr("href", "retornarAlerts/" + 'L/' + val.id + '/' + code);
                    $(this).find('#anchor_edit').attr("href", "/traffic-lights/" + val.id + "/edit");
                });

                $('#modal-select-light').modal('show');
            });

            markers_list.push(marker);
        }

        add_regulator_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: String(val.id),
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture_in + '" alt="' + val.id + '" title="' + val.id + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Reguladora: ' + val.id + '</h4>\
                    <p class="card-text">\
                    <p><strong>Fabricante: </strong>' + val.brand + '</p>\
                    <p><strong>Estado: </strong>' + val.state + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('regulator-boxes/') }}' + '/' + val.id;
                $('#modal-regulator').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Reguladora: ' + val.id);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#light-picture').attr('src', val.picture);
                    $(this).find('#regulator-picture').css('background-image', 'url(' + val.picture_in + ')');
                    $(this).find('#regulator-id').text(val.id);
                    $(this).find('#regulator-code').text(val.code);
                    $(this).find('#regulator-intersection').text(val.intersection);
                    $(this).find('#light-brand').text(val.brand);
                    $(this).find('#light-state').text(val.state);
                    $(this).find('#light-comment').text(val.comment);

                    $(this).find('#anchor_view').attr("href", "/regulator-boxes/" + val.id);
                    $(this).find('#anchor_edit').attr("href", "/regulator-boxes/" + val.id + "/edit");
                });

                $('#modal-regulator').modal('show');
            });

            markers_list.push(marker);
        }

        disable_selectizes = function () {
            $('.tab-pane.show form select').each(function () {
                this.selectize.disable();
            });
        };

        enable_selectizes = function () {
            $('.tab-pane.show form select').each(function () {
                this.selectize.enable();
            });
        };

        filter_reset.click(function (event) {
            event.preventDefault();

            $('.tab-pane.show form select').each(function () {
                this.selectize.clear();
            });
            clear_data();
        });
    });
</script>

