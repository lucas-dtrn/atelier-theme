<?php

/**
 * Block Name: Map
 *
 */


// get fields
$id = $block['id'];
?>

<?php if (get_field("karte_aktivieren")) : ?>

    <div class="map" id="<?= $id ?>">

        <div id="map"></div>
        <?php echo do_shortcode('[borlabs-cookie id="googlemaps" type="content-blocker"][/borlabs-cookie]'); ?>

        <div class="wrapper">
            <div class="content">

                <div class="adress">
                    <h5>Atelier Kunst & Gestalten</h5>
                    <p>Burgstallstraße 6,<br>
                        90587 Obermichelbach</p>
                    <a class="button button-fix --color-accent" href="https://maps.google.com/maps/dir//Atelier+Kunst+und+Gestalten+Burgstallstraße+6+90587+Obermichelbach/@49.5312634,10.9095304,17z/data=!4m5!4m4!1m0!1m2!1m1!1s0x47a20167a9020b65:0xf08aebfeb870e76a"><img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_car_white.svg" height="19.5" width="26" alt=""></a>
                </div>

            </div>

        </div>

    </div>



    <script>
        function initMap() {

            const atelier = {
                lat: 49.53131,
                lng: 10.90954
            };
            const markericon = "https://atelier-delatron.de/wp-content/themes/atelier_theme/assets/img/icons/icon_map_marker.svg";
            const mapStyles = [{
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#e9e9e9',
                        },
                        {
                            lightness: 17,
                        },
                    ],
                },
                {
                    featureType: 'landscape',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#f5f5f5',
                        },
                        {
                            lightness: 20,
                        },
                    ],
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.fill',
                    stylers: [{
                            color: '#ffffff',
                        },
                        {
                            lightness: 17,
                        },
                    ],
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{
                            color: '#ffffff',
                        },
                        {
                            lightness: 29,
                        },
                        {
                            weight: 0.2,
                        },
                    ],
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#ffffff',
                        },
                        {
                            lightness: 18,
                        },
                    ],
                },
                {
                    featureType: 'road.local',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#ffffff',
                        },
                        {
                            lightness: 16,
                        },
                    ],
                },
                {
                    featureType: 'poi',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#f5f5f5',
                        },
                        {
                            lightness: 21,
                        },
                    ],
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#dedede',
                        },
                        {
                            lightness: 21,
                        },
                    ],
                },
                {
                    elementType: 'labels.text.stroke',
                    stylers: [{
                            visibility: 'on',
                        },
                        {
                            color: '#ffffff',
                        },
                        {
                            lightness: 16,
                        },
                    ],
                },
                {
                    elementType: 'labels.text.fill',
                    stylers: [{
                            saturation: 36,
                        },
                        {
                            color: '#333333',
                        },
                        {
                            lightness: 40,
                        },
                    ],
                },
                {
                    elementType: 'labels.icon',
                    stylers: [{
                        visibility: 'off',
                    }, ],
                },
                {
                    featureType: 'transit',
                    elementType: 'geometry',
                    stylers: [{
                            color: '#f2f2f2',
                        },
                        {
                            lightness: 19,
                        },
                    ],
                },
                {
                    featureType: 'administrative',
                    elementType: 'geometry.fill',
                    stylers: [{
                            color: '#fefefe',
                        },
                        {
                            lightness: 20,
                        },
                    ],
                },
                {
                    featureType: 'administrative',
                    elementType: 'geometry.stroke',
                    stylers: [{
                            color: '#fefefe',
                        },
                        {
                            lightness: 17,
                        },
                        {
                            weight: 1.2,
                        },
                    ],
                },
            ];

            var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if (width > 960) {
                var map_view = {
                    lat: 49.530090,
                    lng: 10.847116
                };
                var map_zoom = 12;
            } else {
                var map_view = {
                    lat: 49.588523,
                    lng: 10.904674
                };
                var map_zoom = 11;
            }

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: map_zoom,
                center: map_view,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: false,
                styles: mapStyles,
            });

            const marker = new google.maps.Marker({
                position: atelier,
                map: map,
                title: "Atelier Kunst und Gestalten",
                icon: {
                    url: markericon,
                    scaledSize: new google.maps.Size(48, 67)
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBamNwlBr78a_W7HKycoFPZ8bP_TH5ujEQ&map_ids=d2c866021521b83d&callback=initMap"></script>

<?php endif; ?>