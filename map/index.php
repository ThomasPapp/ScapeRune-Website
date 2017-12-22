<?php
//    if (count(get_required_files()) <= 1) {
//        header("Location: ?page=main");
//        exit;
//    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Complete Map For ScapeRune..">
    <title>Map</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Slabo 27px' rel='stylesheet'>
    <link rel="stylesheet" href="stylesheets/leaflet.css">
    <link rel="stylesheet" href="stylesheets/app.css">

    <script src="js/leaflet.js"></script>
    <script src="js/app.js"></script>

    <style>

    </style>

</head>

<!-- Body for ScapeRune 462 Map -->
<body>
<button id="button" class="button">Menu</button>

<div id="sidebar" class="sidebar">
    <div class="slider"><span id="version">v1.1</span>
        <h1>SR Map</h1>
        <p class="panel"><i class="fa fa-map"></i>
        An interactive worldmap for ScapeRune.
    </div>
    <div class="panel">
        <h3 style="color: #969696;">Changelog</h3> <i class="fa fa-wrench fa-2x"></i>
        <div id="changelog">
            <h6>v1.1 (March 17, 2017)</h6>
            <ul>
                <li>Patched an issue with fractional transforming while zooming</li>
                <li>Optimized js file weight from 1mb to 19kb & css file weight from 142kb to 7kb</li>
                <li>Upgraded webhosting services</li>
            </ul>
            <hr>
            <h6>v1.0 (March 16, 2017)</h6>
            <ul>
                <li>Implemented contextmenu right click UI</li>
                <li>Simplified the sidebar UI</li>
                <li>Compressed map tiles from 116mb to 15mb</li>
            </ul>
            <h6>v1.0 (March 15, 2017)</h6>
             <ul>
                    <li>Inital map release</li>
             </ul>
        </div>
    </div>

    <p class="panel">Email us at <a href="mailto:contact@scaperune.net?Subject=Hello" target="_top">contact@scaperune.net</a> <i class="fa fa-question-circle fa-2x"></i></p>
    <a style="text-decoration: none" href="https://www.scaperune.net/forums/viewforum?forum=28" target="_blank">
        <p style="color: white;" class="panel report">Report a Bug<i style="color: black" class="fa fa-bug fa-2x"></i></p></a>

</div>

<!-- MAP -->
<div id="map"></div>
<script type="text/javascript">
    var mapObject= 'images/map/tiles/{z}/{x}/{y}.png';

    var map = L.map('map', {
        minZoom: 3,
        maxZoom: 5,
        smoothZoom: true,
        smoothZoomDelay: 1000,
        crs: L.CRS.Simple,
        zoomControl: false,
        attributionControl: false,
        contextmenu: true,
        contextmenuWidth: 140,
        contextmenuItems: [{
            text: 'Zoom In',
            icon: 'images/zoom-in.png',
            callback: zoomIn
        }, {
            text: 'Zoom Out',
            icon: 'images/zoom-out.png',
            callback: zoomOut
        }, '-', {
            text: 'Center Map',
            callback: centerMap
        }]
    });

    function centerMap (e) {
        map.panTo(e.latlng);
    }
    function zoomIn (e) {
        map.zoomIn();
    }
    function zoomOut (e) {
        map.zoomOut();
    }


    //maxBounds - 16x256
    var southWest = map.unproject([0, 8192], map.getMaxZoom());
    var northEast = map.unproject([8192, 0], map.getMaxZoom());
    map.setMaxBounds(new L.LatLngBounds(southWest, northEast));

    var tiles = L.tileLayer(mapObject, {
        noWrap: true,
        reuseTiles: true
    }).addTo(map);

    map.setView(new L.LatLng(-126.5, 127.25), 1);

    var tileOverlay = new L.tileLayer(mapObject, {
        minZoom: 3,
        maxZoom: 5
    });

    var miniMap = new L.Control.MiniMap(tileOverlay, {
        toggleDisplay: true,
        zoomLevelFixed: 3.7,
        width: 300,
        height: 300
    }).addTo(map);

    /*
     * Workaround for select browsers that face issues with fractional
     * zoom levels/transforms
     *
     * Untested in Firefox, Opera, NetScape
     * Still prevalent in Chrome at initial zoom level
     */
    (function(){
        var originalInitTile = L.GridLayer.prototype._initTile;
        L.GridLayer.include({
            _initTile: function (tile) {
                originalInitTile.call(this, tile);

                var tileSize = this.getTileSize();

                tile.style.width = tileSize.x + 1 + 'px';
                tile.style.height = tileSize.y + 1 + 'px';
            }
        });
    })();


    var sidebar = L.control.sidebar('sidebar', {
        closeButton: true,
        position: 'left'
    });

    sidebar.addTo(map);


    setTimeout(function () {
        sidebar.show();
    }, 500);

    button = new L.Control.Button(L.DomUtil.get('button'), { toggleButton: 'active' });
    button.addTo(map);
    button.on('click', function () {
        if (button.isToggled()) {
            sidebar.hide();
        } else {
            sidebar.show();
        }
    });

    sidebar.on('show', function () {
        console.log('Sidebar will be visible.');
    });
    sidebar.on('shown', function () {
        console.log('Sidebar is visible.');
    });
    sidebar.on('hide', function () {
        console.log('Sidebar will be hidden.');
    });
    sidebar.on('hidden', function () {
        console.log('Sidebar is hidden.');
    });
    L.DomEvent.on(sidebar.getCloseButton(), 'click', function () {
        console.log('Close button clicked.');
    });
</script>

</body>
</html>