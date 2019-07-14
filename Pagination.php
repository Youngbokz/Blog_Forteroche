<?php
/****************************************PAGINATION.PHP****************************************/


/**
 * class Pagination
 * Generate Pagination 
 */
class Pagination
{
    var $data;

    public function paginate($values, $per_page)
    {
        $total_values = count($values);

        if(isset($_GET['page']))
        {
            $current_page = $_GET['page'];
        }
        else
        {
            $current_page = 1; 
        }

        $counts = ceil($total_values / $per_page);

        $param1 = ($current_page - 1) * $per_page;

        $this->data = array_slice($values, $param1, $per_page);

        for($x=1; $x<= $counts; $x++)
        {
            $numbers[] = $x;
        }
        return $numbers;
    }

    public function fetchResult()
    {
        $resultsValues = $this->data;
        return $resultsValues;
    }
}

$pag = new Pagination;
$data = array("Youngbokz", "eazy", "mynigga", "whatsup");
$numbers = $pag->paginate($data, 1);
$result = $pag->fetchResult();

foreach($result as $res)
{
    echo'<div>'.$res.'</div>';
}

foreach($numbers as $num)
{
    echo '<a href="pagination.php?page=' . $num . '">' .$num. '</a>';
}