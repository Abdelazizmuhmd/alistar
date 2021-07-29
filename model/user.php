<?php
require_once("../model/Model.php");
require_once("../model/order.php");
require_once("../model/report.php");
require_once("../model/mostsoled.php");


?>
<?php
class user extends Model
{
    
    private $firstName;
    private $id;
    private $lastName;  
    private $email;
    private $phone;
    private $address;  
    private $apartmant;
    private $city;
    private $userType;
    private $orders;
    private $report;
 
    function __construct()
    {   $this->orders[]=new order();
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

function __construct0() {
  }
 function __construct1($id)
    { 
   $this->getuser($id);        
    }
    //test
function getordersArray(){
    return $this->orders;
}

   //test

    function getorders($userId){
        $flag=0;
    $this->getvalidation();
    $this->validation->validateNumber($userId,1,30);
    $this->connect();
    if($this->userType=="client" || $this->userType=="guest" ){
    $sql = "select id from `order` where userid=:userid and isdeleted = 0";
    $this->db->query($sql);
    $this->db->bind(':userid',$userId,PDO::PARAM_INT);
        }else{
      
     $sql = "select id from `order` where isdeleted = 0 ";
     $this->db->query($sql);
        $flag=1;
     
        }
    
    $this->db->execute();

        
    $row = $this->db->getdata();
    
    if ($this->db->numRows() > 0){
    foreach($row as $order){
        if($flag==0){
      $this->orders[]=new order($order->id);
        }
        else{
            $this->orders[]=new order($order->id,1);
        }
    }
    }
    }
    
    
    

    
    
    
    
    
    

    
    
     //test
    function getorderdetails($orderid){
     $this->orders[]= new order($orderid);
     $this->orders[0]->getorderdetails($orderid);
    }
    //test
    function makeorder($productdetails,$comment){
    $order=new order($this->id,$productdetails,$comment);
    }
    
    
    function login($email,$password){
        
         $email=trim($email);
        $this->getvalidation();
         $this->validation->validateLength($password,1,75);
        $this->validation->validateEmail($email,1,100);
        $this->connect();
        $sql = "select id from user where email=:email and password=:password";
        $this->db->query($sql);
        $this->db->bind(':password',$password,PDO::PARAM_STR);
        $this->db->bind(':email',$email,PDO::PARAM_STR);       
        $this->db->execute();
        $row = $this->db->getdata();
        if ($this->db->numRows() > 0){
        $this->getuser($row[0]->id);
            session_start();
            $_SESSION["usertype"]=$this->userType;
            $_SESSION['name']=$this->firstName;
            $_SESSION['id']=$this->id;

            
        }
    }
        
    function updateAddress($firstname,$lastname,$address,$apartmant,$city,$phone){
            $firstname=trim($firstname);
            $lastname=trim($lastname);
            $address=trim($address);
            $apartmant=trim($apartmant);
            $city=trim($city);
            $phone=trim($phone);

        
        $this->getvalidation();
        $this->validation->validateStringEAS($firstname,1,40);
        $this->validation->validateStringEAS($lastname,1,40);
        $this->validation->validateMixedString($address,1,500);
        $this->validation->validateMixedString($apartmant,1,300);
        $this->validation->validateStringEAS($city,1,100);
        $this->validation->validateNumber($phone,1,100);
 
        $this->connect();

        $sql = "update user set firstname=:firstname,lastname=:lastname,phone=:phone,  address=:address,apartmant=:apartmant,city=:city where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$this->id,PDO::PARAM_INT);
        $this->db->bind(':address',$address,PDO::PARAM_STR);
        $this->db->bind(':firstname',$firstname,PDO::PARAM_STR);
        $this->db->bind(':lastname',$lastname,PDO::PARAM_STR);
        $this->db->bind(':phone',$phone,PDO::PARAM_STR);
        $this->db->bind(':apartmant',$apartmant,PDO::PARAM_STR);
        $this->db->bind(':city',$city,PDO::PARAM_STR);
        $this->db->execute();
    } 
        
    function guestsignup($firstName,$lastName,$email,$address,$apartment,$city,$phone){
            $firstname=trim($firstname);
            $lastname=trim($lastname);
            $address=trim($address);
            $apartment=trim($apartment);
            $city=trim($city);
            $phone=trim($phone);
            $email=trim($email);

        
          $this->getvalidation();
          $this->validation->validateStringEAS($firstname,1,30);
          $this->validation->validateStringEAS($lastname,1,30);
          $this->validation->validateMixedString($address,1,500);
          $this->validation->validateMixedString($apartment,1,70);
          $this->validation->validateStringEAS($city,1,100);
          $this->validation->validateNumber($phone,1,100);
          $this->validation->validateEmail($email,1,100);

          
        $this->connect();
        $sql = "insert into user(firstname,lastname,address,apartmant,city,email,usertype,phone) values(:firstname,:lastname,:address,:apartmant,:city,:email,:usertype,:phone)";
        $this->db->query($sql);
        $this->db->bind(':firstname',$firstName,PDO::PARAM_STR);
        $this->db->bind(':lastname',$lastName,PDO::PARAM_STR);
        $this->db->bind(':address',$address,PDO::PARAM_STR);
        $this->db->bind(':apartmant',$apartment,PDO::PARAM_STR);
        $this->db->bind(':city',$city,PDO::PARAM_STR);
        $this->db->bind(':email',$email,PDO::PARAM_STR);
        $this->db->bind(':phone',$phone,PDO::PARAM_STR);
        $this->db->bind(':usertype',"guest",PDO::PARAM_STR);
        $this->db->execute();
        $id=$this->db->lastInsertedId();
        $this->getuser($id);
    }
    function signup($firstname,$lastname,$password,$email){
        
            $firstname=trim($firstname);
            $lastname=trim($lastname);
            $email=trim($email); 
    
        
          $this->getvalidation();
                   $this->validation->validateLength($password,1,65);

          $this->validation->validateStringEAS($firstname,1,40);
          $this->validation->validateStringEAS($lastname,1,40);
          $this->validation->validateEmail($email,1,100);

        $this->connect();

        $query = "select * from user where email=:email";
        $this->db->query($query);
        $this->db->bind(':email',$email,PDO::PARAM_STR);
       
        $this->db->execute();
        
        if($this->db->numRows()<=0) 
        {
    
        $sql = "insert into user(firstname,lastname,password,email,Usertype) values(:firstname,:lastname,:password,:email,:usertype)";
        $this->db->query($sql);
        $this->db->bind(':firstname',$firstname,PDO::PARAM_STR);
        $this->db->bind(':lastname',$lastname,PDO::PARAM_STR);
        $this->db->bind(':password',$password,PDO::PARAM_STR);
        $this->db->bind(':email',$email,PDO::PARAM_STR);
        $this->db->bind(':usertype',"client",PDO::PARAM_STR);
        $this->db->execute();
        $id=$this->db->lastInsertedId();
        $this->getuser($id);
}
    }
    

    function getuser($id){
         $this->getvalidation();
          $this->validation->validateNumber($id,1,50);
        
                $this->connect();
        $sql = "select * from user where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$id,PDO::PARAM_INT);
        $this->db->execute();
        $row = $this->db->getdata();
        if ($this->db->numRows() > 0){

        $this->id = $row[0]->id;
        $this->firstName=$row[0]->firstname;
        $this->lastName=$row[0]->lastname;
        $this->email=$row[0]->email;
        $this->phone=$row[0]->phone;
        $this->address=$row[0]->address;
        $this->city=$row[0]->city;
        $this->apartmant=$row[0]->apartmant;
        $this->userType=$row[0]->usertype;
        }
    }
    function deleteuser($id){
         $this->getvalidation();
          $this->validation->validateNumber($id,1,50);
                $this->connect();

        $sql = "update  user set isdeleted=1 where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$id,PDO::PARAM_INT);
        $this->db->execute();
    }
    function checkEmail($email){
        $this->connect();
        $query = "select * from user where email=:email";
        $this->db->query($query);
        $this->db->bind(':email',$email,PDO::PARAM_STR);
       
        $this->db->execute();
        return $this->db->numRows();

        }
            function generateReport(){
        $this->report=new report();
    }
    function generatePassword($length = 6) 
    {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $count = mb_strlen($chars);
    
      for ($i = 0, $result = ''; $i < $length; $i++) {
          $index = rand(0, $count - 1);
          $result .= mb_substr($chars, $index, 1);
      }
    
      return $result;
    }
function sendErrorByMail($message,$to){
        include_once("../other/mailer/PHPMailerAutoload.php");
        $mail = new PHPMailer(TRUE);
        $mail->SMTPOptions = array('ssl'=>array('verify_peer'=>false, 'verify_peer_name'=>false, 'allow_self_signed'=>true));
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';               // Specify main and backup SMTP servers
        $mail->Port = 587;  
        $mail->SMTPAuth = true;  
        $mail->SMTPSecure = 'tls';                                // Enable SMTP authentication
        $mail->Username = 'move20miu2020@gmail.com';                 // SMTP username
        $mail->Password = 'rywuqlxruswomhuj';                           // SMTP password
        /*bbgysbwvhdvmaxn*/                        
                                         
        
        $mail->setFrom('hrcompany213@gmail.com', 'Mailer');
        $mail->AddAddress($to);
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'PatStore ForgetPassword';
        $mail->Body    = ''.$message;
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        }
function forgetPassword($email){
$this->connect();
$fpassowrd = $this->generatePassword();
if($this->checkEmail($email) > 0){
$fsql = "update user set password='".sha1($fpassowrd)."' where email = :email ";
$this->db->query($fsql);
$this->db->bind(':email',$email,PDO::PARAM_STR);
$this->db->execute($fsql);
$this->sendErrorByMail("Your new password is ".$fpassowrd."",$email);
}
}
function getreport(){
    return $this->report;
}
function getMostSell(){
    $this->mostsoled=new mostsoled();
    
}
function getSell(){
return $this->mostsoled;
}
    
    function setID($id)
    {
        $this->id =$id;
    }
    function setfirstName($firstName)
    {
        $this->firstName =$firstName;
    }
    function setlastName($lastName)
    {
        $this->lastName =$lastname;
    }
    function setEmail($email)
    {
        $this->email =$email;
    }
    function setPhone($phone)
    {
        $this->phone =$phone;
    }
    function setAdress($adress)
    {
        $this->adress =$adress;
    }
    function setApartmant($apartmant)
    {
        $this->apartmant =$apartmant;
    }
    function setCity($city)
    {
        $this->city =$city;
    }
    function setuserType($userType)
    {
        $this->userType =$userType;
    }
    function getID()
    {
      return $this->id;
    }
    function getfirstName()
    {
      return $this->firstName;
    }
    function getlastName()
    {
      return $this->lastName;
    }
    function getEmail()
    {
      return $this->email;
    }
    function getPhone()
    {
      return $this->phone;
    }
    function getAddress()
    {
      return $this->address;
    }
    function getApartmant()
    {
      return $this->apartmant;
    }
    function getCity()
    {
      return $this->city;
    }
    function getuserType()
    {
      return $this->userType;
    }
}


?>