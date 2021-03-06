<div class="layout">
    <?php
        $DB = new DB;
        $showData = $DB->getWhere("Spectacles","idSpectacle", $data['idShow']);
        
        setcookie("basePrice", $showData['prix_de_base']);

        PageFrame::loadBundle();
        PageFrame::header();

    ?>
    <link rel="stylesheet" href="<?php echo $_SERVER["basePath"] ?>public/css/details.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.css' rel='stylesheet' />
    
    <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <script src="<?php echo $_SERVER["basePath"] ?>public/js/eventInfo.js"></script>
    
    <!-- getCookie function and onclick buttons-->
    <script>
        
        
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }

    </script>
    <div id="contentContainer">
        <div id="infoContainer">
            <div>
                <h4><a id="nav-link" href="list?search=&category=<?php echo $categoryId ?>"><?php echo $categoryName ?></a> / <?php echo $artist ?></h4>
                <img class="banner" src="<?php echo $_SERVER["basePath"] ?>public/images/show/show<?php echo $data['idShow'] ?>.jpg">    
            </div>
            <div class="eventDetails">
                <h1><?php echo $title ?></h1>
                <h2><?php echo $date." &bull; ".$time ?></h2>
                <br>
                <h4><?php echo $artist ?></h4>
                <div>
                    <a class="aVenue" href="#moreInfoContainer"><h3><i class="smallIcon fas fa-map-marker-alt"></i><?php echo $venue ?></h3></a>
                </div>
                <a class="aBuyButton" href="#extraContainer"><div class="buyButton">Acheter Billets</div></a>
            </div>
        </div>
        <hr>
        <div id="descriptionContainer">
            <h3>Description</h3>
            <h4><?php echo $description ?></h2>
        </div>
    </div>
    <div id="extraContainer">
        <div id="extraNav">
            <div id="buttonContainer">
                <div id="salleButton" class="selected" style="width:50%">Carte de salle</div><a id="moreInfoButton" class="unselected" style="width:50%">Information sur le lieu </a>
            </div>
        </div>
        <div id="salleContainer" classs="row">
            <div class="col-9">
                <h2></h2>
                <img id="sceneImg" src="<?php echo $_SERVER["basePath"] ?>public/images/scene/<?php echo $venueInfo['Id'] ?>/0.png">
            </div>
            <div class="col-3">
                <h3 class="ticketTitle">Choisir la section</h3>
                <div id="sectionBilletsContainer">
                    <?php
                        $colorScheme = [
                            "rgba(2, 108, 223,0.5)",
                            "rgba(223, 2, 108,0.5)",
                            "rgba(108, 223, 2,0.5)",
                            "rgba(223, 117, 2,0.5)"
                        ];
                        $currentSection = 1;
                        foreach($venueInfo['Sections'] as $section){
                            echo ('<a><div class="sectionBillet click-me" id="section'.$currentSection.'" style="background-color: '.$colorScheme[$currentSection-1].'">'.$section.'</div></a>');
                            $currentSection = $currentSection + 1;
                        }
                    ?>
                </div>
                <p id="sectionError" style="color:red;display:none;">* Veuillez choisir la section</p>
                <h3 class="ticketTitle">Nombre de billets</h3>
                <div id="nbBilletsContainer">
                    <a class="click-me"><div>1</div></a>
                    <a class="click-me"><div>2</div></a>
                    <a class="click-me"><div>3</div></a>
                    <a class="click-me"><div>4</div></a>
                    <a class="click-me"><div id="5plus">5 +</div></a>
                </div>
                <div class="slidecontainer click-me" style="display:none;">
                    <input type="range" min="5" max="15" value="5" class="slider" id="ticketRange">
                    <div id="demoDiv"><span id="demo"></span></div>
                </div>
                <p id="nbError" style="color:red;display:none;">* Veuillez choisir le nombre de billets</p>
                <script>
                    var slider = document.getElementById("ticketRange");
                    var output = document.getElementById("demo");
                    output.innerHTML = slider.value;

                    slider.oninput = function() {
                        output.innerHTML = this.value;
                    }
                </script>
                
                <div id='subtotalDiv'>
                    <h3>Sous-Total</h3>
                    <t style="font-size: large;" id="subtotal"></t>
                </div>
                <script>

                    var selectedSectionJS = document.getElementsByClassName("selectedSection");
                    var selectedNumber = document.getElementsByClassName("selectedNb");
                    var subtotalT = document.getElementById("subtotal");

                    var tempStorage;

                    var sectionStorage;
                    var numberOfTicketsStorage;

                    var venueInfo = <?php echo json_encode($venueInfo, JSON_PRETTY_PRINT) ?>;
                    var basePrice = Number(getCookie('basePrice'));

                    $('.click-me').click(function (event) {

                        // Log the clicked element in the console
                        tempStorage = event.target.innerHTML;
                        

                        if(tempStorage.length > 3)
                        {
                            console.log("string");
                            sectionStorage = event.target.innerHTML;
                        }
                        else if(tempStorage.length < 2)
                        {
                            console.log("number");
                            numberOfTicketsStorage = Number(event.target.innerHTML);
                            if(numberOfTicketsStorage === 0)
                            {
                                numberOfTicketsStorage = Number(slider.value);
                            }
                        }

                        price = Number(venueInfo['multipSection'][sectionStorage]) * numberOfTicketsStorage * basePrice;

                        if(price > 0)
                        {
                            subtotalT.innerHTML = price + "$";
                        }

                    });


                </script>
                <div class="checkoutButton">Passer la commande</div>
            </div>
        </div>
        <div id="moreInfoContainer" style="visibility:hidden;position: absolute;top:-10000">
            <div>
                <div id="mapContainer">
                    <div style="margin-top:30px;">
                        <h3><?php echo $venue ?></h3>
                        <h4><?php echo $venueAddress ?></h4>
                    </div>
                    <div id='map'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
PageFrame::footer();
?>
<script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYmxhaXplZmYiLCJhIjoiY2s5bTYwZmlwMmRndzNmbzFpcjJoczlwMiJ9.cogH7m0a7U4jCtT7aH8WHg';
        var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
        mapboxClient.geocoding
            .forwardGeocode({
                query: "<?php echo $venueAddress ?>",
                autocomplete: false,
                limit: 1
            })
            .send()
            .then(function(response) {
                if (
                    response &&
                    response.body &&
                    response.body.features &&
                    response.body.features.length
                ) {
                    var feature = response.body.features[0];

                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: feature.center,
                        zoom: 10
                    });
                    //map.on('load', () => {
                    //    map.resize();
                    //});  
                    new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
                }
            });

            

            
    </script>