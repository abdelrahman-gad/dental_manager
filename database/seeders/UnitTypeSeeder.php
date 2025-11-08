<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;
class UnitTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run():void
    {
      $directions = [UnitType::DIRECTION_LEFT, UnitType::DIRECTION_RIGHT];
      $levels = [UnitType::LEVEL_UPPER, UnitType::LEVEL_LOWER];
      foreach ($directions as $direction) {
          foreach ($levels as $level) {
              for($order=1; $order<=8; $order++){
                  $this->createUnitType($direction, $level, $order);
              }
          }
      }
    }

    /**
     * @param string $direction
     * @param string $level
     * @param int $order
     *
     * @return void
     */

    private function createUnitType(string $direction, string $level,int $order ): void{
        $unitType = UnitType::where([
            'direction' => $direction,
            'level' => $level,
            'order' => $order,
        ])->first();

        if(!isset($unitType)){
            UnitType::create([
                'direction' => $direction,
                'level' => $level,
                'order' => $order,
            ]);
        }
    }
}
