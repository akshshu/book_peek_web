<?php

/*for each(){}
  //echo 'asfg';
  $car = "tata";
  $bus = "motor";
  //echo $car;
  echo $car . $bus; //concatenation
  echo "\nthe thing is $car $bus\n";
  //echo 'this is $car';//wont work
  echo strlen($car);
  $people = ['shawn', 'akss', 'jue'];
  $food = array('apple', 'banana', 'grape');
  $number = array(10, 20, 200);
  echo ("\n"); //echo('\n') doesnt work
  print_r($food);
  $number[] = 90; //append vaue at the end of array or use array_push($number,90)
  print_r($number);
  echo ("\n" . count($food)) . '</br>'; //counts no of elements

  $people_food = array_merge($people, $food); //merge two arrays
  print_r($people_food);
  //associative arrys (keyor index&valuepair)/kinf of mapping
  $people_lang = ['shawn' => 'eng', 'akash' => 'hind'];
  echo $people_lang["akash"];
  echo ("\n");
  print_r($people_lang);
  foreach ($number as $num) {
    echo $num . '<br />';
  }
  function say_hello($name = "shawn") //default value is shawn
  {
    echo "\ngood mrning $name";
  }
  say_hello("akash");
  function Show_product($product)
  {
    echo "\n{$product['name']} has a price of {$product['price']}";
  }
  Show_product(['name' => 'watch', 'price' => 200]);
}*/

include('config/db_connect.php');
//write query for all books
$sql = 'SELECT  id,title,author,contents FROM books ORDER BY created_at';
//makequery adn get resut
$result = mysqli_query($conn, $sql);
//fetch the resulting row as an array
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free resut from memory
mysqli_free_result($result);
//freedatabase connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<?php include('main/header.php'); ?>
<h4 class="center gray-text">Books!</h4>
<div class="container">
  <div class="row">
    <?php foreach ($books as $book) { ?>
      <div class="col s4 ">
        <div class="card z-depth-0">
          <img src="book.svg" class="book">
          <div class="card-content ">
            <h6 class="center"><?php echo htmlspecialchars($book['title']); ?></h6>
            <label class="desc">Author :<?php echo htmlspecialchars($book['author']); ?></label>
            <label class="desc">Content :<?php echo htmlspecialchars($book['contents']); ?></label>

          </div>
          <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $book['id'] ?>">More Info</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<?php include('main/footer.php'); ?>



</html>