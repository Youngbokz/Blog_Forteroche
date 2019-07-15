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

        $start = ($current_page - 1) * $per_page;

        $this->data = array_slice($values, $start, $per_page);

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




//TEST=====================
$pag = new Pagination;
$data = array("Youngbokz", "eazy", "mynigga", "whatsup");
$numbers = $pag->paginate($data, 1);
$result = $pag->fetchResult();

foreach($result as $res)
{
    echo'<div>'.$res.'</div>';
}


?>
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php foreach($numbers as $num)
{?>
    <li class="page-item"><a class="page-link" href="pagination.php?page=<?= $num; ?>"><?= $num; ?></a></li>
    <?php
}
?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


