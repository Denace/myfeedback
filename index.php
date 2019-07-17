<html>
<head>
    <title>My Feedback</title>
    <style>
        body {
            width: 550px;
            font-family: Arial;
        }

        #frm-qr {
            padding: 20px 40px;
            background: #CCC;
            border-radius: 3px;
        }

        .input-field {
            padding: 10px;
            border: 0px;
            border-radius: 3px;
            width: 250px;
        }

        .submit-button {
            background: #333;
            color: #FFF;
            padding: 10px 20px;
            border-radius: 3px;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .result-heading {
            padding: 10px 0px 2px 0px;
            border-bottom: #333 1px solid;
            margin-bottom: 20px;
        }

        #validation-info {
            display: none;
            padding: 10px 20px;
            background: #f5c7c8;
            border: #e6bbbd 1px solid;
        }

        .qrlist{
            padding: 10px 0px 2px 0px;
            width: 500px;
        }
        ul {
            list-style-type: none;
            border: 4px dotted green;
        }
        li span{
            align: left;
            font-size: 2em;

        }
        .qr{
            float:right;

        }
            .state-icon {
            left: -5px;
        }
        .list-group-item-primary {
            color: rgb(255, 255, 255);
            background-color: rgb(66, 139, 202);
        }

        /* DEMO ONLY - REMOVES UNWANTED MARGIN 
            .well .list-group {
            margin-bottom: 0px;
        }*/

    </style>
     <link rel="stylesheet" href="/Myfeedback/bootstrap.min.css">
     <script src="/Myfeedback/jquery-3.2.1.min.js"></script>
     <script src="/Myfeedback/popper.min.js"></script>
     <script src="/Myfeedback/bootstrap.min.js"></script>
</head>
<body>
    <form method="post" name="feedback" id="frm-qr"action="index.php">
        <div class="form-row">
            Name: <input type="text" name="name_field" id="name_field" class="input-field" />
        </div>
        <div class="form-row">
            Email: <input type="email" name="email_field" id="email_field" class="input-field" />
        </div>
        <div class="form-row">
            Comments: <textarea rows="10" cols="10" class="input-field" name="comments_field" id="comments_field" ></textarea>
        </div>
        <div>
            <input type="submit" name="submit" class="submit-button"value="Submit" />           
        </div>
    </form>  
</body>

<?php
    include 'mysqlconnection.php';
        
    $email=$_POST["email_field"];
    $name =$_POST["name_field"];
    $comments=$_POST["comments_field"];
    

    if(isset($email,$comments)){
        save_comment($email,$comments);
        //get_comment();
        //echo $email." ". $name." ". $comments ;
    }

    function save_comment($k,$c){
        try{
            $conn=OpenCon();
            $sql="INSERT INTO comment (c_id,u_id,feedback)VALUES (NULL,$k,$c)";  
            //$query="SELECT * FROM `comment`";
                    /*('1', 'dkieme@chaitrading.com', 'I am dennis'),('2', 'kiemeden@gmail.com', 'I am denace!')*/ 
            //var_dump($conn);
            if($conn->query($sql))
                echo "feedback sent!";
            else {
                echo "Error: Our query failed to execute and here is why: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $conn->errno . "\n";
                echo "Error: " . $conn->error . "\n";
            }      
        }
        catch(Exception $e)  
        {  
            echo("Error!".$e);  
        }
        
    }
    function get_comment(){
        $conn=OpenCon();
        $sql="select * from comment";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc()){
            echo $row['u_id']." --- commented----> ".$row['feedback'];
        }

    }
    function delete_comment($id){}
    function edit_comment($id){}

?>
</html>