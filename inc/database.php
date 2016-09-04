<?php
/*
*		Description: Provides a data layer to the 'World App'.
*		Date: September 2nd, 2016
*		Author: Matt Price
*/

/*
*	Manages the connection to a MySQL database.
*/
class Database
{
	// The database user name.
	protected $user;
	
	// The database password.
	protected $pass;
	
	// The database server host name.
	protected $hostName;
	
	// The name of the database.
	protected $databaseName;

	public function __construct($hostName, $user, $pass, $database)
    {
		$this->hostName = $hostName;
		$this->user = $user;
		$this->pass = $pass;
        $this->databaseName = $database;
    }

	/*
	* Connects to the MySQL database
	*/
	private function Connect() {
		// Connect to the database using the credentials that were passed in.
		$databaseConnection = new mysqli($this->hostName, $this->user, $this->pass, $this->databaseName);

		// Check if a connection error occurred.
		if ($databaseConnection->connect_error) {
				die("Connection failed: " . $databaseConnection->connect_error);
		} 
		
		// Indicate that a connection was made.
		return $databaseConnection;
	}

	/*
	* Retrieves all cities within a country. 
	* @param string $aCountryCode The country code.
	*	@returns array $results A list of cities.
	*/
	public function GetCities($aCountryCode) {
		// Create connection
		$conn = $this->Connect();

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT ID, Name, CountryCode, Population FROM city WHERE CountryCode = '".$aCountryCode."'";
		$result = $conn->query($sql);

		$results = [];
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$results[] = $row;
			}
		} 

		$conn->close();

		return $results;
	}

	/*
	* Retrieves all of the countries of the world.
	* @returns array $results A list of countries.
	*/
	public function GetCountries() {
		// Create connection
		$conn = $this->Connect();

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT Code, Name, Continent, Region, Population, LifeExpectancy, GNP FROM country";
		$result = $conn->query($sql);

		$results = [];
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$results[] = $row;
			}
		}

		$conn->close();

		return $results;
	}

	/*
	* Removes a city from the database.
	* @param int $cityId The ID of the city to delete.
	* @returns bit $result returns 1 if successful, otherwise 0.
	*/
	public function DeleteCity($cityId) {
		
		// Create connection
		$conn = $this->Connect();

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "DELETE FROM city WHERE ID=$cityId";

		$result;
		if ($conn->query($sql) === TRUE) {
			$result = 1;
		} else {
			$result = 0;
		}

		$conn->close();

		return $result;
	}

	/*
	* Updates an existing city in the database.
	* @returns bit $result returns 1 if successful, otherwise 0.
	*/
	public function UpdateCity($countryCode, $id, $population, $name) {
		
		// Create connection
		$conn = $this->Connect();

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE city SET CountryCode='".$countryCode."', Name='".$name."', Population='".$population."' WHERE id=".$id;

		$result;
		if ($conn->query($sql) === TRUE) {
			$result = 1;
		} else {
			$result = 0;
		}

		$conn->close();

		return $result;
	}

	/*
	* Adds a new city to the database.
	* @param string @countryCode The country code of the new city.
	* @param string @population The population of the new city.
	* @param string @name The name of the new city.
	* @returns bit $result returns 1 if successful, otherwise 0.
	*/
	public function AddCity($countryCode, $population, $name) {
		
		// Create connection
		$conn = $this->Connect();

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "INSERT INTO city (CountryCode, Name, Population) VALUES ('".$countryCode."', '".$name."','".$population."')";

		$result;
		if ($conn->query($sql) === TRUE) {
			$result = 1;
		} else {
			$result = 0;
		}

		$conn->close();

		return $result;
	}
}