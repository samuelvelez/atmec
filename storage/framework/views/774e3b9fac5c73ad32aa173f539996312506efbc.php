<script type="text/javascript">
    let map;
    let bounds = new google.maps.LatLngBounds();
    let alert_marker;

    let signals_list = <?php echo json_encode($signals); ?>;
    let smarkers = new Map();

    let regulators_list = <?php echo json_encode($regulators); ?>;
    let rmarkers = new Map();

    let devices_list = <?php echo json_encode($devices); ?>;
    let dmarkers = new Map();

    let poles_list = <?php echo json_encode($poles); ?>;
    let pmarkers = new Map();

    let tensors_list = <?php echo json_encode($tensors); ?>;
    let tmarkers = new Map();

    let lights_list = <?php echo json_encode($lights); ?>;
    let lmarkers = new Map();

    function show_map() {
        let LatitudeAndLongitude = new google.maps.LatLng(<?php echo e($latitude); ?>, <?php echo e($longitude); ?>);

        var mapOptions = {
            scrollwheel: false,
            disableDefaultUI: false,
            draggable: false,
            zoom: 16,
            center: LatitudeAndLongitude,
            mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
        };

        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        alert_marker = new google.maps.Marker({
            map: map,
            title: 'Alerta: <?php echo e($alert_id); ?>',
            position: LatitudeAndLongitude
        });
    }

    show_map();

    // ADD SIGNALS
    $.each(signals_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: {
                url: "<?php echo e(asset('images/icons/signal.png')); ?>",
                scaledSize: new google.maps.Size(30, 30)
            },
            //icon: "<?php echo e(asset('images/icons/signal.png')); ?>",
            title: 'Señal: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        smarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#signals")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });

    // ADD REGULATORS
    $.each(regulators_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: {
                url: "<?php echo e(asset('images/icons/regulator.png')); ?>",
                scaledSize: new google.maps.Size(30, 30)
            },
            title: 'Reguladora: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        rmarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#regulators")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });

    // ADD DEVICES
    $.each(devices_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: {
                url: "<?php echo e(asset('images/icons/device.png')); ?>",
                scaledSize: new google.maps.Size(30, 30)
            },
            title: 'Dispositivo: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        dmarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#devices")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });

    // ADD POLES
    $.each(poles_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: {
                url: "<?php echo e(asset('images/icons/pole.png')); ?>",
                scaledSize: new google.maps.Size(30, 30)
            },
            title: 'Poste: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        pmarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#poles")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });

    // ADD TENSORS
    /*$.each(tensors_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
            title: 'Tensor: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        tmarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#tensors")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });*/

    // ADD LIGHTS
    $.each(lights_list, function (index, item) {
        let marker = new google.maps.Marker({
            map: map,
            icon: {
                url: "<?php echo e(asset('images/icons/light.png')); ?>",
                scaledSize: new google.maps.Size(30, 30)
            },
            title: 'Semáforo: ' + item.id + '',
            position: new google.maps.LatLng(item.latitude, item.longitude),
        });

        lmarkers.set(item.id, marker);
        google.maps.event.addDomListener(marker, 'click', function() {
            $("#lights")[0].selectize.addItem(item.id);
            this.setMap(null);
        });
        bounds.extend(marker.position);
    });

    map.fitBounds(bounds);
</script>



<?php /**PATH /home/atmdeveqadoor/resources/views/scripts/gmaps-report-create.blade.php ENDPATH**/ ?>