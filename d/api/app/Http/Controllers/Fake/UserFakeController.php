<?php

namespace App\Http\Controllers\Fake;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserFakeController extends Controller
{
	// public function getByNameAge(){
	// 	$start_time = microtime(true);
	// 	$data = DB::select("SELECT * from users where age > 75 and country = 'Albania'");
	// 	$end_time = microtime(true);
	// 	$execution_time = ($end_time - $start_time);//5 sec no index = 
	// 	$memoryUsage = $this->memoryUsage(); 
	// 	dd($data,$execution_time,$memoryUsage);
	// }
	public function getByNameAge(){
		DB::select("DELETE FROM users;");
		die;
		$start_time = microtime(true);
		$data = DB::select("SELECT country from users where country like '%islands%'");
		$end_time = microtime(true);
		$execution_time = ($end_time - $start_time);//5 sec no index = 
		$memoryUsage = $this->memoryUsage(); 
		dd($data,$execution_time,$memoryUsage);
	}

	public function memoryUsage() {
		// Get memory usage in bytes
		$memory = memory_get_usage();
	
		// Convert bytes to human-readable format
		$units = array('B', 'KB', 'MB', 'GB', 'TB');
		$formatted_memory = @round($memory / pow(1024, ($i = floor(log($memory, 1024)))), 2) . ' ' . $units[$i];
	
		// Return memory usage
		return $formatted_memory;
	}

	public function createUsers()
	{
		$n = [1, 2, 3, 4, 5,6,7,8,9,10];

		foreach ($n as $i) {
			$this->makeFake();
		}

		echo 'success '. User::count();
	}

	private function makeFake()
	{
		$countries = $this->getCountry();

		DB::select("INSERT INTO users (username, email, registration_date, last_login, age, country)
	SELECT  CONCAT('user', numbers.n, RAND(),RAND()) AS username,
		CONCAT('user', numbers.n, '@example.com') AS email,
		DATE_SUB(CURRENT_DATE(), INTERVAL FLOOR(RAND()*365) DAY) AS registration_date,
		FROM_UNIXTIME(UNIX_TIMESTAMP() - FLOOR(RAND() * 60 * 60 * 24 * 365)) AS last_login,
		FLOOR(18 + RAND() * 60) AS age,
		CASE 
		WHEN RAND() < 0.1 THEN '".$countries[array_rand($countries)]."'
        WHEN RAND() < 0.3 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.2 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.4 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.5 THEN '".$countries[array_rand($countries)]."'
        WHEN RAND() < 0.6 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.7 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.8 THEN '".$countries[array_rand($countries)]."'
		WHEN RAND() < 0.9 THEN '".$countries[array_rand($countries)]."'
        ELSE '".$countries[array_rand($countries)]."'
        END AS country
	FROM
		(SELECT @row := @row + 1 AS n FROM
			(SELECT 0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS a,
			(SELECT 0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS b,
			(SELECT 0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS c,
			(SELECT 0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS d,
			(SELECT 0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS e,
			
			(SELECT @row := 0) AS init
		) AS numbers
	LIMIT 100000
		");
	}

	private function getCountry(){
		return [
			"afghanistan",
			"albania",
			"algeria",
			"andorra",
			"angola",
			"antigua_and_barbuda",
			"argentina",
			"armenia",
			"australia",
			"austria",
			"azerbaijan",
			"bahamas",
			"bahrain",
			"bangladesh",
			"barbados",
			"belarus",
			"belgium",
			"belize",
			"benin",
			"bhutan",
			"bolivia",
			"bosnia_and_herzegovina",
			"botswana",
			"brazil",
			"brunei",
			"bulgaria",
			"burkina_faso",
			"burundi",
			"cabo_verde",
			"cambodia",
			"cameroon",
			"canada",
			"chad",
			"chile",
			"china",
			"colombia",
			"comoros",
			"costa_rica",
			"croatia",
			"cuba",
			"cyprus",
			"czechia",
			"denmark",
			"djibouti",
			"dominica",
			"dominican_republic",
			"ecuador",
			"egypt",
			"el_salvador",
			"equatorial_guinea",
			"eritrea",
			"estonia",
			"eswatini",
			"ethiopia",
			"fiji",
			"finland",
			"france",
			"gabon",
			"gambia",
			"georgia",
			"germany",
			"ghana",
			"greece",
			"grenada",
			"guatemala",
			"guinea",
			"guinea_bissau",
			"guyana",
			"haiti",
			"honduras",
			"hungary",
			"iceland",
			"india",
			"indonesia",
			"iran",
			"iraq",
			"ireland",
			"israel",
			"italy",
			"ivory_coast",
			"jamaica",
			"japan",
			"jordan",
			"kazakhstan",
			"kenya",
			"kiribati",
			"kosovo",
			"kuwait",
			"kyrgyzstan",
			"laos",
			"latvia",
			"lebanon",
			"lesotho",
			"liberia",
			"libya",
			"liechtenstein",
			"lithuania",
			"luxembourg",
			"madagascar",
			"malawi",
			"malaysia",
			"maldives",
			"mali",
			"malta",
			"marshall_islands",
			"mauritania",
			"mauritius",
			"mexico",
			"micronesia",
			"moldova",
			"monaco",
			"mongolia",
			"montenegro",
			"morocco",
			"mozambique",
			"myanmar",
			"namibia",
			"nauru",
			"nepal",
			"netherlands",
			"new_zealand",
			"nicaragua",
			"niger",
			"nigeria",
			"north_korea",
			"north_macedonia",
			"norway",
			"oman",
			"pakistan",
			"palau",
			"palestine",
			"panama",
			"papua_new_guinea",
			"paraguay",
			"peru",
			"philippines",
			"poland",
			"portugal",
			"qatar",
			"romania",
			"russia",
			"rwanda",
			"saint_kitts_and_nevis",
			"saint_lucia",
			"saint_vincent_and_the_grenadines",
			"samoa",
			"san_marino",
			"sao_tome_and_principe",
			"saudi_arabia",
			"senegal",
			"serbia",
			"seychelles",
			"sierra_leone",
			"singapore",
			"slovakia",
			"slovenia",
			"solomon_islands",
			"somalia",
			"south_africa",
			"south_korea",
			"south_sudan",
			"spain",
			"sri_lanka",
			"sudan",
			"suriname",
			"sweden",
			"switzerland",
			"syria",
			"taiwan",
			"tajikistan",
			"tanzania",
			"thailand",
			"timor_leste",
			"togo",
			"tonga",
			"trinidad_and_tobago",
			"tunisia",
			"turkey",
			"turkmenistan",
			"tuvalu",
			"uganda",
			"ukraine",
			"united_arab_emirates",
			"united_kingdom",
			"united_states",
			"uruguay",
			"uzbekistan",
			"vanuatu",
			"vatican_city",
			"venezuela",
			"vietnam",
			"yemen",
			"zambia",
			"zimbabwe"
		];
	}
}
