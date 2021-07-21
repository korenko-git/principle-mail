<?php 
namespace Classes;
use Classes\DB;

class Principle {
  public static $activePrinciple = "work";
	public static $principle = [
		"work" => [
			"table" => "pr_work",
			"title_rus" => "ПРИНЦИП РАБОТЫ",			
			"title_eng" => "WORK PRINCIPLE",
			"max_rows" => 171,

      "bg_file" => [
        "path" => "/bg-work.png",
        "width" => 1080,
        "height" => 1080,
      ],
      "title_header" => [
        "top_font_size" => 50,
        "x" => 97,
        "y" => 125,
      ],
      "principle_text" => [        
        "x" => 159,
        "y" => 353,
      ]
		],
		"life" => [
			"table" => "pr_life",
			"title_rus" => "ЖИЗНЕННЫЙ ПРИНЦИП",
			"title_eng" => "LIFE PRINCIPLE",
			"max_rows" => 149,

      "bg_file" => [
        "path" => "/bg-life.png",
        "width" => 960,
        "height" => 960,
      ],
      "title_header" => [
        "top_font_size" => 34,
        "x" => 55,
        "y" => 117,
      ],
      "principle_text" => [        
        "x" => 240,
        "y" => 330,
      ]
		]
	];

	public static function getActivePrinciple() {
		return self::$principle[self::$activePrinciple];
	}

	public static function getRandomPrinciple() {
    ['table' => $principleTable]  = self::getActivePrinciple();
    $result = DB::query("SELECT * FROM `$principleTable` ORDER BY RAND() LIMIT 1;");
    if ($result && ($principleData = $result->fetch_assoc())) {
      return $principleData;
    }
    return null;
  }

  public static function getPrincipleByDate($date) {
    [
      'table' => $principleTable, 
      'max_rows' => $principleMax
    ]  = self::getActivePrinciple();

    $selectedDate = strtotime(date($date));

    $weekOfYear = +date("W", $selectedDate);
    $fistDayOfWeek = +date('N',strtotime(date('Y-01-01')));
    $selectedDayOfWeek = +date('N', $selectedDate);

    $workDayOfFirstWeek = 5 - $fistDayOfWeek >= 0? 6 - $fistDayOfWeek:0;
    $workDayOfBetweenWeek = ($weekOfYear - 2) * 5;
    $workDayOfSelectedWeek = 5 - $selectedDayOfWeek >= 0? $selectedDayOfWeek:5;

    $workDayOfSelectedDate = $workDayOfFirstWeek + $workDayOfBetweenWeek + $workDayOfSelectedWeek;

    if ($workDayOfSelectedDate > $principleMax) $workDayOfSelectedDate = $workDayOfSelectedDate % $principleMax + 1;

    $result = DB::query("SELECT * FROM `$principleTable` WHERE `id`=$workDayOfSelectedDate");
    if ($result && ($principleData = $result->fetch_assoc())) {
      return $principleData;
    }
    return null;
  }

  public static function getPrincipleById($id, $lang) {
    ['table' => $principleTable]  = self::getActivePrinciple();
    $result = DB::query("SELECT `$lang` FROM `$principleTable` WHERE `id`=$id");
    if ($result && ($principleData = $result->fetch_assoc())) {
      return $principleData[$lang];
    }
    return null;
  }
}
