function selectCountry(countryCode)
{
    $.ajax({
    method: "POST",
    url: "inc/ajax.php",
    data: { code: countryCode, requestType: "getCities" }
    })
    .done(function( msg ) {
        $("#data-table").html(msg);
        $("#back-countries-button").removeClass("hidden");
        $("#add-city-button").removeClass("hidden");
        $("#add-city-button").click(function() {
            addCitymodal(countryCode);
        });
        $("#all-countries").text("Cities with the Country Code: '" + countryCode + "'");
    })
    .fail(function() {
        console.log( "Cities not retrieved." );
    })
}

function getAllCountries()
{
    $.ajax({
    method: "POST",
    url: "inc/ajax.php",
    data: { requestType: "getAllCountries" }
    })
    .done(function( msg ) {
        $("#data-table").html(msg);
        $("#back-countries-button").addClass("hidden");
        $("#add-city-button").addClass("hidden");
        $("#add-city-button").off(); // Remove all click handlers.
        $("#all-countries").text("Countries of the World");
    })
    .fail(function() {
        console.log( "Countries not retrieved." );
    })
}

function deleteCity(countryCode, cityId, cityName)
{
    var proceedWithDeletion = confirm("Are you sure you want to delete the city '" + cityName  + "'?");
    if (proceedWithDeletion) {
       $.ajax({
        method: "POST",
        url: "inc/ajax.php",
        data: { countryCode: countryCode, cityId: cityId, requestType: "deleteCity" }
        })
        .done(function( msg ) {
            selectCountry(countryCode);
        })
        .fail(function() {
            console.log( "City was not deleted." );
        })
    }    
}

function updateCity(cityId, cityName, cityCountryCode, cityPopulation) {
    $.ajax({
    method: "POST",
    url: "inc/ajax.php",
    data: { cityCountryCode: cityCountryCode, cityId: cityId, cityName: cityName, cityPopulation: cityPopulation, requestType: "updateCity" }
    })
    .done(function( msg ) {
        $('#updateCityModal').modal('hide');
        selectCountry(cityCountryCode);
    })
    .fail(function() {
        console.log( "City was not updated." );
    })
}

function addCity(cityName, cityCountryCode, cityPopulation) {
    $.ajax({
    method: "POST",
    url: "inc/ajax.php",
    data: { cityCountryCode: cityCountryCode, cityName: cityName, cityPopulation: cityPopulation, requestType: "addCity" }
    })
    .done(function( msg ) {
        $('#addCityModal').modal('hide');
        selectCountry(cityCountryCode);
    })
    .fail(function() {
        console.log( "City was not added." );
    })
}