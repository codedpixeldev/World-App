<?php
/*
*		Description: Browse, delete, update and add cities to the world. Demonstrate HTML, MySQL and PHP Interaction.
*		Date: September 2nd, 2016
*		Author: Matt Price
*/

// Include the PHP data layer.
include 'inc/database.php';

// Instantiate the database object with our connection info.
$worldDatabase = new Database("localhost", "mysql_user", "123", "world");

// Set the base URL for the app.
$baseUrl = "http://localhost/phpapp/";
?>
<html>
<head>
<title>World App</title>
<!-- Include JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Include Boostrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Include Custom App Scripts -->
<script src="js/ajax.js"></script>
<script src="js/world.js"></script>

<!-- Include Boostrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<!-- Include Custom App CSS -->
<link href="./styles/style.css" rel="stylesheet">
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
</head>
<body>

<!-- Create the navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?=$baseUrl?>">
        <img alt="Brand" src="images/earth-147591.png" class="app-logo">
        <div class="app-heading">The World App</div>
      </a>
    </div>
  </div>
</nav>
<div id="messages">
<!--
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
-->
</div>

<!-- The main app HTML container -->
<div class="container-fluid">
	<div class="row">
		<div class=".col-xs-12 .col-md-8 world-app-content">
			<h2 id="all-countries">Countries of the World</h2>

			<a class="btn btn-default hidden" id="back-countries-button" href="#" role="button" onclick="getAllCountries();">Back To Countries</a>
			<a class="btn btn-default hidden" id="add-city-button" href="#" role="button">Add City</a>

			<div id="data-table">
				<table class="table">
					<thead>
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
						<?php
						// Retrieve all countries from the database.
						$allCountries = $worldDatabase->GetCountries();

						// Add each country as a new row to the HTML table.
						foreach($allCountries as $aCountry)
						{
								$code = $aCountry["Code"];
								echo "<tr>"
								."<td>".$code."</td>"
								."<td>"."<a href=\"#\" onclick=\"selectCountry('$code')\">".$aCountry["Name"]."</a></td>"
								."<td>".$aCountry["Region"]."</td>"
								."<td>".$aCountry["Population"]."</td>"
								."<td>".$aCountry["LifeExpectancy"]."</td>"
								."<td>".$aCountry["GNP"]."</td>"
								."</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Dialog For Updating Cities Start -->
<div class="modal fade" id="updateCityModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update City </h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
            <input id="id" type="hidden" class="form-control">
            <input id="city" type="text" class="form-control" placeholder="City Name">
            <input id="code" type="text" class="form-control" placeholder="Country Code">
            <input id="population" type="text" class="form-control" placeholder="Population">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateCitySubmit()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Dialog For Updating Cities End -->

<!-- Modal Dialog For Adding Cities Start -->
<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update City </h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
            <input id="city" type="text" class="form-control" placeholder="City Name">
            <input id="code" type="text" class="form-control" placeholder="Country Code">
            <input id="population" type="text" class="form-control" placeholder="Population">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addCitySubmit()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Dialog For Adding Cities End -->

</body>
</html>