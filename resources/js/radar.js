    function RadarAPI(api_key, radius) {
    this.api_key = api_key;
    this.radius = radius;
    this.api_root_endpoint = "https://api.radar.io/v1/";
    this.api_geofences_endpoint = this.api_root_endpoint + "geofences";
    this.xhttp = new XMLHttpRequest();

    this.createReviewGeofence = function (longitude, latitude, username) {
    }

    this.getTouchingGeofences = function (longitude, latitude) {
    }

    this.createGeofence = function (longitude, latitude) {
    }

    this.getGeofences = function() {
        const jsonData = this.httpRequestJSON(this.xhttp, this.api_geofences_endpoint);
        console.log(jsonData);
    }

    this.httpRequestJSON = function(xhttp, url) {
        const HTTP_OK = 200;
        const DONE_STATE = 4;

        xhttp.onreadystatechange = function() {
            if(this.readyState == DONE_STATE && this.status == HTTP_OK) {
                const jsonData = JSON.parse(this.responseText);
                return jsonData;
            }
        }
    }
}
