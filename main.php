<?php

$matrix = [
    [83, 12, 50, 93, 99],
    [79, 14, 15, 70, 1],
    [32, 68, 6, 59, 87],
    [54, 50, 86, 82, 62],
    [9, 19, 57, 88, 99]
];

class MyClass
{
    public function analyze_matrix(): array
    {
        global $matrix;
        if (is_array($matrix)) {
            $count_x = round(count($matrix[0]) / 2);
            $count_y = round(count($matrix) / 2);
            $data = $this->_calculation_square($count_x, $count_y);
            $square_max_delivery = array_keys($data, max($data));
            $start_coord = (intval(substr($square_max_delivery[0], 0, 1)) + 1) . "." . (intval(substr($square_max_delivery[0], 0, 1)) + 1);
            $end_coord = (intval(substr($square_max_delivery[0], 0, 1)) + $count_x) . "." . (intval(substr($square_max_delivery[0], 0, 1)) + $count_y);
            $warehouse_coord = (((intval(substr($square_max_delivery[0], 0, 1)) + 1) + (intval(substr($square_max_delivery[0], 0, 1)) + $count_x)) / 2) . "." . (((intval(substr($square_max_delivery[0], 0, 1)) + 1) + (intval(substr($square_max_delivery[0], 0, 1)) + $count_y)) / 2);

            return array(
                "result" => true,
                "start_coord" => $start_coord,
                "end_coord" => $end_coord,
                "warehouse_coord" => $warehouse_coord
            );

        } else {
            return array(
                "result" => false
            );
        }

    }

    private function _calculation_square($count_x, $count_y): array
    {
        $result = [];
        if (isset($count_x, $count_y)) {
            for ($i = 0; $i <= $count_y; $i++) {
                for ($j = 0; $j <= $count_x; $j++) {
                    $keys = [];
                    array_push($keys, $i . $j);
                    $result += array_fill_keys($keys, $this->_number_next_delivers($i, $j, $i + $count_y, $j + $count_x));
                }
            }
        }
        return $result;
    }


    private function _number_next_delivers($y, $x, $max_y, $max_x): int
    {
        $sum = 0;
        if (isset($y, $x, $max_y, $max_x)) {
            global $matrix;
            $count_x = count($matrix);
            $count_y = count($matrix[0]);
            for ($i = $y; $i < $max_y; $i++) {
                for ($j = $x; $j < $max_x; $j++) {
                    if ($max_x <= $count_x && $max_y <= $count_y) {
                        $sum += $matrix[$i][$j];
                    }
                }
            }
            return $sum;
        }
        return $sum;
    }
}

$resultObject = new MyClass();
var_dump($resultObject->analyze_matrix());
