<?php

require_once("../view/View.php");

class viewCheckOut extends View{

function userdetails(){
    
if(isset($_REQUEST['note'])) {
        $_REQUEST['note']="";
 }else{
      $_REQUEST['note']="";
 }
$dis="disabled";
 if($this->model->getEmail()==""){
$dis="";
}
   echo" 
     <div class='section section--shipping-address' data-shipping-address>
       <div class='section__header'>
         <h2 class='section__title'>
             Shipping address
         </h2>
       </div>
   
       <div class='section__content'>
           
           <div class='fieldset'>
             <div class='address-fields' data-address-fields>
    
   
  
                 <form action='../public/checkout.php?action=makeorder' id='myform' method='POST'>
          
                     <input type='text' name='comment' id='comment'value='".$_REQUEST["note"]."' hidden>

     <div class='field field field--required' >
       <div class='field__input-wrapper'>
         <input value='".$this->model->getfirstName()."' name='firstname'  placeholder='First Name'  class='field__input'  type='text'id='firstName' maxlength='20' onkeyup='validate()' required   />
         <p id='Fname' style='color:red;'></p>
         </div>
   </div>
                 
                 
                      <div class='field field field--required' >

       <div class='field__input-wrapper'>
         <input value='".$this->model->getlastName()."'name='lastname' placeholder='Last name'   class='field__input' type='text' id='lastName'maxlength='20' onkeyup='validate()' required/>
         <p id='Lname' style='color:red;'></p>

         </div>
         </div>
            <div class='field field field--required' >
       <div class='field__input-wrapper'>
         <input value='".$this->model->getEmail()."' name='email' size='40' type='email'  id='checkout_email' placeholder='Email'  class='field__input'  type='text' onkeyup='validate()'  required $dis/>
         <p id='mail' style='color:red;'></p>

         </div>
   </div>
         
             
                 
     <div  class='field field--required'>
       <div class='field__input-wrapper'>
           
       <input value='".$this->model->getAddress()."' name='address' placeholder='Address'  class='field__input'  type='text' id='adress' maxlength='500' onkeyup='validate()' required />
       <p id='Adress' style='color:red;'></p>

       </div>
     </div>
                 
       <div  class='field field--optional'>
         <div class='field__input-wrapper'>
           <input value='".$this->model->getApartmant()."' name='apartmant' placeholder='Apartmant'  class='field__input'  type='text' id='apartment'maxlength='40' onkeyup='validate()' required   />
           <p id='Apartment' style='color:red;'></p>

           </div>  
   </div>
           <div class='field--third field field--required' >
       <div class='field__input-wrapper field__input-wrapper--select'>
   <select  class='field__input field__input--select' >
   <option  value='egypt'>EGYPT</option>
           </select>
           
         
       </div>
   </div>

                    
     <div  class='field field--required'>
       <div class='field__input-wrapper'>
        

<select name='city' id='city' value='".$this->model->getCity()."' class='field__input field__input--select' >
   <option  value='Cairo'>Cairo</option>
   <option  value='Giza'>Giza</option>
   <option  value='Alexandria'>Alexandria</option>
   <option  value='Qalyubia'>Qalyubia</option>
   <option  value='Port Said'>Port Said</option>
   <option  value='Suez'>Suez</option>
   <option  value='Gharbia'>Gharbia</option>
   <option  value='Dakahlia'>Dakahlia</option>
   <option  value='Asyut'>Asyut</option>
   <option  value='Fayoum'>Fayoum</option>
   <option  value='Sharqia'>Sharqia</option>
   <option  value='Ismailia'>Ismailia</option>
   <option  value='Aswan'>Aswan</option>
   <option  value='Beheira'>Beheira</option>
   <option  value='Minya'>Minya</option>
   <option  value='Damietta'>Damietta</option>
   <option  value='Luxor'>Luxor</option>
   <option  value='Qena'>Qena</option>
   <option  value='Beni Suef'>Beni Suef</option>
   <option  value='Sohag'>Sohag</option>
   <option  value='Monufia'>Monufia</option>
   <option  value='Red Sea'>Red Sea</option>
   <option  value='Kafr el-Sheikh'>Kafr el-Sheikh</option>
   <option  value='North Sinai'>North Sinai</option>
   <option  value='Matruh'>Matruh</option>
   <option  value='Hurghada'>Hurghada</option>
   <option  value='10th of Ramadan City'>10th of Ramadan City</option>
   <option  value='Shibin el-Kom'>Shibin el-Kom</option>
   <option  value='Sharm el-Sheikh'>Sharm el-Sheikh</option>
   <option  value='Tanta'>Tanta</option>


</select>
 <p id='City' style='color:red;'></p>



         </div>
   </div>
                 
                 
   
    
       <div  class='field field--optional'>
         <div class='field__input-wrapper field__input-wrapper--icon-right'>
           <input value='".$this->model->getPhone()."' name='phone' placeholder='phone'   class='field__input field__input--numeric'  type='tel'id='phoneNumber' maxlength='11' onkeyup='validate()' required />
           <p id='Phone' style='color:red;'></p>

           <div class='field__icon'>
           
         </div>
   </div>
       
       
   </div>
   
   
              
               </div>
           </div> 
       </div> 
     </div>
   
     </div>
       <div class='step__footer' data-step-footer>

      <button onclick ='return validate()' class='step__footer__continue-btn btn' >
        <span class='btn__content' >Make Order</span>
       </button>
</form>
     ";
 }
 
  

}

?>



