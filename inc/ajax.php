<?php
include 'database.php';
$worldDatabase = new Database("localhost", "mysql_user", "123", "world");

if (isset($_POST))
{
    if ($_POST['requestType'] == 'getCities')
    {
        $countryCode = $_POST['code'];
        $allCities = $worldDatabase->GetCities($countryCode);

        $responseData = "
        <table class='table'><thead>
              <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>City Name</th>
                <th>Country Code</th>
                <th>Population</th>
              </tr>
            </thead>
            <tbody>
        ";

        if (is_array($allCities) && count($allCities) > 0) {
            foreach($allCities as $aCity)
            {
                $cityId = $aCity["ID"];
                $cityName = $aCity["Name"];
                $cityCountryCode = $aCity["CountryCode"];
                $cityPopulation = $aCity["Population"];

                $responseData .= "<tr>"
                ."<td><a href='#' onclick=\"deleteCity('$countryCode', '$cityId', '$cityName')\">Delete</a> | "
                ."<a href='#' onclick=\"updateCityModal('$cityId', '$cityName', '$cityCountryCode', '$cityPopulation')\">Update</a></td>"
                ."<td>".$cityId."</td>"
                ."<td>".$cityName."</td>"
                ."<td>".$cityCountryCode."</td>"
                ."<td>".$cityPopulation."</td>"
                ."</tr>";
            }
        } else {
            $responseData .= "<tr><td></td><td>No Results</td><td></td><td></td></tr>";
        }

        $responseData .= "</tbody></table>";

        echo $responseData;
    }

    if ($_POST['requestType'] == 'getAllCountries')
    {
        $allCountries = $worldDatabase->GetCountries();

        $responseData = "
        <table class='table'><thead>
              <tr>
                <th>Code</th>
                <th>City Name</th>
                <th>Region</th>
                <th>Population</th>
                <th>Life Expectancy</th>
                <th>GNC</th>
              </tr>
            </thead>
            <tbody>
        ";

        if (is_array($allCountries) && count($allCountries) > 0) {
            foreach($allCountries as $aCountry)
            {
                $code = $aCountry["Code"];
                $responseData .= "<tr>"
                ."<td>".$code."</td>"
                ."<td>"."<a href=\"#\" onclick=\"selectCountry('$code')\">".$aCountry["Name"]."</a></td>"
                ."<td>".$aCountry["Region"]."</td>"
                ."<td>".$aCountry["Population"]."</td>"
                ."<td>".$aCountry["LifeExpectancy"]."</td>"
                ."<td>".$aCountry["GNP"]."</td>"
                ."</tr>";
            }
        }
        
        $responseData .= "</tbody></table>";

        echo $responseData;
    }

    if ($_POST['requestType'] == 'deleteCity')
    {
        $result = $worldDatabase->DeleteCity((int)$_POST["cityId"]);

        echo $result;
    }

    if ($_POST['requestType'] == 'updateCity')
    {
        $result = $worldDatabase->UpdateCity($_POST["cityCountryCode"], $_POST["cityId"], $_POST["cityPopulation"], $_POST["cityName"]);
    
        echo $result;
    }

    if ($_POST['requestType'] == 'addCity')
    {
        $result = $worldDatabase->AddCity($_POST["cityCountryCode"], $_POST["cityPopulation"], $_POST["cityName"]);
    
        echo $result;
    }
}
