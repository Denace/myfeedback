<html>
<head>
    <title>My Feedback</title>
    <style>
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
            align: right;
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
<div class="container">
    <nav class="navbar sticky-top navbar-light bg-light">
        <a class="nav-link" href="#">Home</a>
        <a class="nav-link" href="#frm">Feedback</a>
        <a class="nav-link" href="#address">Contacts</a>
    </nav>
    <div class="row justify-content-center" > 
    <div class="col-md-auto">  
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block rounded" src="images/ny.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>New York</h3>
                            <p>this is a NY concert</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block rounded" src="images/chicago.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Chicago</h3>
                            <p>A concert in Illinois</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block rounded" src="images/la.jpg" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Los Angeles</h3>
                            <p>LA is humid and fun!</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center"> 
        <div class="col-md-5">
            <h2 class="display-3" id="frm">Take a few minutes to give feedback!</h2> <br/>
            <form method="post" name="feedback" id="frm-qr"action="index.php">
                <div class="form-row">
                    Name: <input type="text" name="name_field" id="name_field" class="input-field"  required/>
                </div>
                <div class="form-row">
                    Email: <input type="email" name="email_field" id="email_field" class="input-field" required />
                </div>
                <div class="form-row">
                    Comments: <textarea rows="10" cols="10" class="input-field" name="comments_field" id="comments_field" required></textarea>
                </div>
                <div>
                    <input type="submit" name="submit" class="submit-button"value="Submit" />           
                </div>
            </form>
        </div> 
        <div class="col-md-5">
            <h2 class="display-3" id="com">comments section</h2>
            <div>
                   <!-- <input type="submit" name="fetchComments" class="submit-button" value="Fetch Comments" formmethod="POST" formaction="index.php"/>  -->         
            </div>
            <div id="comments"></div>
        </div>
    </div> 
    <div class="row justify-content-center"> 
        <address id="address">
                <b>Ivy Gitiba</b><br/>
                <Label>Phone Number:</label> +254 658 254<br/>
                <Label>IG:</label>myig<br/>
                <Label>Address:</label> 21346 Links Road<br/>
        </address>
    </div>
</div>  
</body>

<?php
    include 'mysqlconnection.php';
        
    $email=$_POST["email_field"];
    $name =$_POST["name_field"];
    $comments=$_POST["comments_field"];
    

    if(isset($email,$comments)){
        save_comment($name,$email,$comments);
        get_comments();
    }
    /*
        if(isset($_POST['fetchComments'])){
            get_comments();
        }
     */

    function save_comment($n,$k,$c){
        try{
            $conn=OpenCon();
            $sql="INSERT INTO comment (`name`,`u_id`,`feedback`)VALUES ('$n','$k','$c')";  
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
    function get_comments(){
        $conn=OpenCon();
        $sql="select * from comment";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc()){
            //echo $row['u_id']." --- commented----> ".$row['feedback'];
            ?>
            <script>
               var x=<?php echo json_encode($row);?>;
               $(x).each(function(){
                   $("#comments").append($("<ul class='list-group  list-group-item'></ul>")
                                        .append("<li>"+"<span>"+'Who:'+"</span>"+x.name+"</li>")
                                        .append("<li>"+"<span>"+'email:'+"</span>"+x.u_id+"</li>")
                                        .append("<li>"+"<span>"+'they said:'+"</span>"+x.feedback+"</li>")
                                     )        
               });

            </script>
            <?

        }

    }
    /**
     * To be implemented edit and delete functions
     */
    function delete_comment($id){}
    function edit_comment($id){}

?>
</html>