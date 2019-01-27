<?php
    include_once "database.inc.php";

// if the barcode field is filled then filsl the prepared statement with a name search
$test = false;

if(isset($_POST['code'])) {
    $test = true;
    $code = $_POST['code'];
}
if(isset($_POST['submit']) || $test) {
if(isset($_POST['barcode_num']) || $test)
{
    $barcode = !$test ? mysqli_real_escape_string($conn,$_POST['barcode_num']) : mysqli_real_escape_string($conn,$code);

    $sql = "SELECT * from items WHERE barcode_num = $barcode";

    $result = mysqli_query($conn,$sql);

     if(!$result || mysqli_num_rows($result) <= 0)
     {
         echo "No items found with barcode number $barcode";
     }
     else
    {
        //depending on which statement was use, the program will return the name,picture and confirmation if that was your item
        //the app will also display if the item is recyclable (and potentially other information)????
        $row = mysqli_fetch_assoc($result);
        $data = array($row['name'],$row['picture'],$row['recycable']);
        session_start();
        $_SESSION['data'] = $data;
        if(!$test) {
            header("Location: ../show_item.html");
        }
    }

}



// if the name field is filled then fills the prepared statement with a name search
elseif(isset($_POST['name']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql = "SELECT * from items WHERE name = '$name'";
   /* $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "Search failed please try again";

    }
    else
    {
        $stmt->bind_param("s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $numberofRows = mysqli_stmt_num_rows($stmt);
    }
    */
   $result = mysqli_query($conn,$sql);
     if(!$result || mysqli_num_rows($result) <= 0)
     {
         echo "No items found named $name";
     }
    else
    {
        //depending on which statement was use, the program will return the name,picture and confirmation if that was your item
        //the app will also display if the item is recyclable (and potentially other information)????
        $row = mysqli_fetch_assoc($result);
        $data = array($row['name'],$row['picture'],$row['recycable']);
        session_start();
        $_SESSION['data'] = $data;
        header("Location: ../show_item.html");
    }


}
} else {
    echo "Error";
}
//header('Location: index.html');

?>
