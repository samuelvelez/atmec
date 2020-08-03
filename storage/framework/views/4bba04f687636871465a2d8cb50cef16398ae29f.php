<script type="text/javascript">

    function google_maps_geocode_and_map() {
        var LatitudeAndLongitude = new google.maps.LatLng(<?php echo e($latitude); ?>, <?php echo e($longitude); ?>);

        var mapOptions = {
            scrollwheel: false,
            disableDefaultUI: false,
            draggable: true,
            zoom: 16,
            center: LatitudeAndLongitude,
            mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
        };

        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var marker = new google.maps.Marker({
            map: map,
            //icon: "",
            title: '<strong><?php echo e($code); ?></strong>',
            position: map.getCenter()
        });
    }

    google_maps_geocode_and_map();

</script>
<?php /**PATH /home/atmeccom/resources/views/scripts/google-maps-atm-show.blade.php ENDPATH**/ ?>