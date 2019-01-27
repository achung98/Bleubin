<?php
    include_once "includes/database.inc.php";

// if the barcode field is filled then filsl the prepared statement with a name search
if(isset($_POST['submit']))
{
if(isset($_POST['barcode_num']))
{
    $barcode = mysqli_real_escape_string($conn,$_POST['barcode_num']);
    
    $sql = "SELECT * from ITEMS WHERE barcode_num = $barcode";

        $result = mysqli_query($conn,$sql);

     if(empty($result))
     {
         echo "No items found with barcode number $barcode";
     }
     else
    {
        //depending on which statement was use, the program will return the name,picture and confirmation if that was your item
        //the app will also display if the item is recyclable (and potentially other information)????
        while($row = mysqli_fetch_assoc($result))
        {
            $data = array($row['name'],$row['picture'],$row['picture']);
            echo $data;
            header("Location: show_item.html");
        }
    }
    
}



// if the name field is filled then fills the prepared statement with a name search
elseif(isset($_POST['name']))
{
    $name = mysqli_real_escape_string($_POST['name']);
    $sql = "SELECT * from items WHERE name=$name";

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
    if(empty($result))
    {
        echo "No items found with name $name";
    }
    else
    {
        //depending on which statement was use, the program will return the name,picture and confirmation if that was your item
        //the app will also display if the item is recyclable (and potentially other information)????
        while($row = mysqli_fetch_assoc($result))
        {
            //echo $result;
            //displays the
        }
    }
        
    
}
}
//header('Location: index.html');

?>