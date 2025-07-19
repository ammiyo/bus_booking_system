<?php
include('db.php');
//extracting dropdown list from earning types table




//extracting station category from station category table dropdown list

//Extracting earning types from earning types table using checkbox

//Extracting station features from station feature table using checkboxes

//view station 

function get_start(){
          global $con;
          $earning_types_sql = 'SELECT DISTINCT bstart FROM `bus_details` ORDER BY bstart';
          $run_earning_types_sql = mysqli_query($con, $earning_types_sql);
          
          while($rows = mysqli_fetch_assoc($run_earning_types_sql))
          {
          
			echo "<option value=\"".$rows["bstart"]."\"";
             if(@$_POST['bstart'] == $rows['bstart'])
                    echo 'selected';
                   
              echo ">".$rows["bstart"]."</option>"; 
			
          } 
		  
}
function get_end(){
          global $con;
          $earning_types_sql = 'SELECT DISTINCT bend FROM `bus_details` ORDER BY bend';
          $run_earning_types_sql = mysqli_query($con, $earning_types_sql);
          
          while($rows = mysqli_fetch_assoc($run_earning_types_sql))
          {
          
                     echo "<option value=\"".$rows["bend"]."\"";
             if(@$_POST['bend'] == $rows['bend'])
                    echo 'selected';
                   
              echo ">".$rows["bend"]."</option>"; 
                     
          } 
                
}
function get_course1(){
          global $con;
          $earning_types_sql = 'SELECT DISTINCT cname from `registration` INNER JOIN `course` ON registration.course_id = course.id';
          $run_earning_types_sql = mysqli_query($con, $earning_types_sql);
          
          while($rows = mysqli_fetch_assoc($run_earning_types_sql))
          {
          
                     echo "<option value=\"".$rows["cname"]."\"";
             if(@$_POST['cname'] == $rows['cname'])
                    echo 'selected';
                   
              echo ">".$rows["cname"]."</option>"; 
                     
          } 
                
}
?>  