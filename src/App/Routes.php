<?php

declare(strict_types=1);
require __DIR__ . '/../../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$container = $app->getContainer();

$app->group('/elevator', function () use ($app): void {
  // TO DO: GET - Get a floor of Single Elevator
  $app->get('/{id}', function(Request $request, Response $response) {
    $id = $request->getAttribute('id');
  });

  // POST - Create number of elevators
  $app->post('', function(Request $request, Response $response) {
    try {
      $num = $request->getParam('num');
      for ($i = 0; $i < $num; $i++) {
        $index = $i + 1;
        $arrKey = "elev". (string)$index;
        $floor[$arrKey] = 1;
      }

      $path = substr(__DIR__, 0, -3) . '.env';

      // Update the .env file.
      if (file_exists($path)) {
        $oldString1 = "ELEVATOR_CAR_COUNT=" . $_ENV["ELEVATOR_CAR_COUNT"];
        $newString1 = "ELEVATOR_CAR_COUNT=" . $num;

        $oldString2 = "FLOOR_COUNT=" . $_ENV["FLOOR_COUNT"];
        $newString2 = "FLOOR_COUNT=" . json_encode($floor);
        
        $str = file_get_contents($path);
        $str = str_replace($oldString1, $newString1, $str);
        $str = str_replace($oldString2, $newString2, $str);

        file_put_contents($path, $str);
      }
      $_ENV["ELEVATOR_CAR_COUNT"] = $num;
      echo $_ENV["ELEVATOR_CAR_COUNT"];
    } catch (Exception $e) {
      $app->response()->header('X-Status-Reason', $e->getMessage());
    }
  });

  // Update a floor of the elevator 
  $app->put('/{id}', function(Request $request, Response $response) {
    try {
      $id = $request->getAttribute('id');
      $floor = $request->getParam('floor');
      $floors = $_ENV["FLOOR_COUNT"];

      $floorArr = json_decode($floors, true);
      $floorArr = (array) $floorArr;
      $floorArr[$id] = $floor;

      $path = substr(__DIR__, 0, -3) . '.env';

      // Update the .env file.
      if (file_exists($path)) {
        $oldString2 = "FLOOR_COUNT=" . $_ENV["FLOOR_COUNT"];
        $newString2 = "FLOOR_COUNT=" . json_encode($floorArr);
        
        $str = file_get_contents($path);
        $str = str_replace($oldString2, $newString2, $str);

        file_put_contents($path, $str);
      }
      $_ENV["FLOOR_COUNT"] = json_encode($floorArr);
      echo $_ENV["FLOOR_COUNT"];
    } catch (Exception $e) {
      $app->response()->header('X-Status-Reason', $e->getMessage());
    }
  });

  // TO DO: Delete an elevator 
  $app->delete('/delete/{id}', function(Request $request, Response $response) {
    $id = $request->getAttribute('id');
  });
});
