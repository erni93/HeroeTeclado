<?php 
function sqlite_open($location) 
{ 
    $conexion = new SQLite3($location); 
    return $conexion; 
} 
function sqlite_query($conexion,$query) 
{ 
    $array['conexion'] = $conexion; 
    $array['query'] = $query; 
    $result = $conexion->query($query); 
    return $result; 
} 
function sqlite_fetch_array(&$result) 
{ 
    #Get Columns 
    $i = 0; 
    while ($result->columnName($i)) 
    { 
        $columns[ ] = $result->columnName($i); 
        $i++; 
    } 
    
    $resx = $result->fetchArray(SQLITE3_ASSOC); 
    return $resx; 
} 
?> 