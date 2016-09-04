function updateCityModal(cityId, cityName, cityCountryCode, cityPopulation) {
    $("#updateCityModal #city").val(cityName);
    $("#updateCityModal #id").val(cityId);
    $("#updateCityModal #code").val(cityCountryCode);
    $("#updateCityModal #population").val(cityPopulation);
    $("#updateCityModal").modal();
}

function addCitymodal(cityCountryCode) {
    $("#addCityModal #code").val(cityCountryCode);
    $("#addCityModal").modal();
}

function updateCitySubmit() {
    updateCity(
        $("#updateCityModal #id").val(), 
        $("#updateCityModal #city").val(), 
        $("#updateCityModal #code").val(), 
        $("#updateCityModal #population").val()
    );
}

function addCitySubmit() {
    addCity(
        $("#addCityModal #city").val(), 
        $("#addCityModal #code").val(), 
        $("#addCityModal #population").val()
    );
}