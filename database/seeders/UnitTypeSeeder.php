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

      $quarter1 = [
          UnitType::LEVEL_UPPER . '_' . UnitType::DIRECTION_LEFT => 1,
          UnitType::LEVEL_UPPER . '_' . UnitType::DIRECTION_RIGHT => 2,
          UnitType::LEVEL_LOWER . '_' . UnitType::DIRECTION_RIGHT => 3,
          UnitType::LEVEL_LOWER . '_' . UnitType::DIRECTION_LEFT => 4,
      ];

      foreach ($levels as $level) {
          foreach ($directions as $direction) {
              for($i=1; $i<=8; $i++){
                  $order = $quarter1[$level . '_' . $direction].''.$i;
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
