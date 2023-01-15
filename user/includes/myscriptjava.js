
    function validatePhoneNo(phoneNo)  
        {
            var numbers = /^[0-9]+$/;
            if (phoneNo.match(numbers))
                return true;            
            else return false;
        } 


    function validateEmail(email)
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(email.match(mailformat))
                return true;            
            else return false;
        }


    function validateForm()
        {
            var aa = document.forms["myForm"]["f_Name"].value;
            var bb = document.forms["myForm"]["l_Name"].value;
            var cc = document.forms["myForm"]["phoneNo"].value;
            var dd = document.forms["myForm"]["email"].value;
            var ee = document.forms["myForm"]["license_Type"].value;
            var ff = document.forms["myForm"]["expiration"].value;
            var gg = document.forms["myForm"]["staff_Positon"].value;
            var hh = document.forms["myForm"]["staff_Salary"].value;

            if ((a == "") || (bb =="") || (cc =="") || (dd =="") || (ee =="") || (ff =="") || (gg =="") || (hh ==""))
            {
                alert("Please complete your form");
            }

            else if (validatePhoneNo(cc) == false)
            {
                alert("Your phone number must be in numeric only") 
            }     

            else if (validateEmail(dd) == false)
            {
                alert("Your email format is not correct");
            }

            else if (validateEmail(hh) == false)
            {
                alert("Salary must be in numeric only");
            }

            else
                alert("Register successful!");
            return false;
         }

        function checkPassword()
            {
                var pass = f.R_Pass.value;
                var cpass = f.R_CPass.value;

                if(pass==cpass)
                    alert("Password has been successfully changed!");
                else
                    alert("Your password does not match");
            }
