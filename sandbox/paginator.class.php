<?php 
  
  // https://code.tutsplus.com/tutorials/how-to-paginate-data-with-php--net-2928
  // https://www.startutorial.com/articles/view/php-pagination-tutorial

  class Paginator{
    
    private $_connection;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    }

  public function _construc($connection, $query){
   
    $this -> _connection = $connection;
    $this -> _query = $query;
    
    $re = $this -> _connection -> query($this -> _query);
    $this -> _total = $rs -> num_rows;
  
  }

  public function getData( $limit= 10, $page = 1){
    
    $this -> _limit = $limit;
    $this -> _page = $page;
    
    if($this -> _limit =='all'){
      
      $query = $this -> _query;
    } else{
      
      $query = $this -> _query." LIMIT ".(($this -> _page - 1) * $this -> _limit).", $this -> _limit"; 
    }
    
    $rs = $this -> _connection -> query($query);
    
  }

?>
