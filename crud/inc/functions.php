<?php
define('DB_NAME','e:\\xampp\\htdocs\\php\\crud\\data\\db.txt');
function seed( ){
    $data=array(
        array(
            'id'=> 1,
           'fname'=>"Akash",
           'lname'=>"khan",
           'roll'=>"12"

        ),
        array(
            'id'=> 2,
           'fname'=>"Shadin",
           'lname'=>"khan",
           'roll'=>"19"

        ),
        array(
            'id'=> 3,
           'fname'=>"Ashik",
           'lname'=>"Monjil",
           'roll'=>"1"

        ),
        array(
            'id'=> 4,
           'fname'=>"Hasan",
           'lname'=>"Mahmud",
           'roll'=>"2"

        ),
        array(
            'id'=> 5,
           'fname'=>"Mehedi",
           'lname'=>"Hsasan",
           'roll'=>"52"

        ),
    );
    $serializedData=serialize($data);
    file_put_contents(DB_NAME,$serializedData,LOCK_EX);
}
?>
<?php
function generateReport(){
    $serializedData=file_get_contents(DB_NAME);
    $students=unserialize($serializedData);
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Roll</th>
            <th>Action</th>
        </tr>
   
    <?php foreach($students as $student){
        ?>
        <tr>
            <td><?php printf( '%s %s',$student['fname'],$student['lname']);?></td>
            <td><?php printf( ' %s',$student['roll']);?></td>
            <td><?php printf( '<a href="index.php?task=edit&id=%s">Edit</a> | <a class="delete" href="index.php?task=delete&id=%s">Delete</a>',$student['id'],$student['id']);?></td>
            
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
function addStudent($fname,$lname,$roll){
    $found=false;
    $serializedData=file_get_contents(DB_NAME);
    $students=unserialize($serializedData);
    foreach($students as $_student){
       
        if($_student['roll']==$roll){
            $found=true;
            break;
        }
    }
    if(!$found){
    $newId=getNewId($students);
    $student=array(
        'id'=>$newId,
        'fname'=>$fname,
        'lname'=>$lname,
        'roll'=>$roll
    );
    array_push($students,$student);
    $serializedData=serialize($students);
    file_put_contents(DB_NAME,$serializedData,LOCK_EX);
   return true;
}
return false;
}
function getStudent($id){
    $serializedData=file_get_contents(DB_NAME);
    $students=unserialize($serializedData);
    foreach($students as $student){
        if($student['id']==$id){
          return $student;
        }
    }
    return false;
}
function updateStudent($id,$fname,$lname,$roll){
    $found=false;
    $serializedData=file_get_contents(DB_NAME);
    $students=unserialize($serializedData);
    foreach($students as $_student){
       
        if($_student['roll']==$roll && $_student['id']!=$id){
            $found=true;
            break;
        }
    }
    if(!$found){

    $students[$id-1]['fname']=$fname;
    $students[$id-1]['lname']=$lname;
    $students[$id-1]['roll']=$roll;
    
    $serializedData=serialize($students);
    file_put_contents(DB_NAME,$serializedData,LOCK_EX);
    return true;
    }
    return false;
}
function deleteStudent($id){
    $serializedData=file_get_contents(DB_NAME);
    $students=unserialize($serializedData);
    unset($students[$id-1]);
    $serializedData=serialize($students);
    file_put_contents(DB_NAME,$serializedData,LOCK_EX);
}

function getNewId($students){
    $maxId=max(array_column($students,'id'));
    return $maxId+1;
}