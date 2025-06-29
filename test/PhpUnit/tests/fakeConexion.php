<?php
class fakeConexion {
    public static function getConexion(array $responses)
    {
        $conexion = $thisMock = new class {
            public $queries = [];
            public function query($sql) {
                $this->queries[] = $sql;
                global $responses;
                foreach ($responses as $pattern => $response) {
                    if (strpos($sql, $pattern) !== false) return $response;
                }
                return true;
            }
            public function real_escape_string($str) {
                return addslashes($str);
            }
            public function getExecutedQueries() {
                return $this->queries;
            }
        };
        return $conexion;
    }
}
