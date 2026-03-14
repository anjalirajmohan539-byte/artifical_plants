<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student — Registration</title>
<link href="css/test.css" rel="stylesheet">
</head>
<body>
 <div class="container">

  <aside class="card-right">
      <div class="avatar-preview" id="avatarBox">
        <div style="text-align:center;padding:10px;color:var(--muted)">
          <div style="font-size:18px;font-weight:700">Welcome!</div>
          <div class="small">Upload a profile photo to preview here.</div>
        </div>
      </div>

      <div style="width:100%;text-align:center;margin-top:8px">
        <div class="muted-note">We protect your data — secure authentication and encrypted storage.</div>
      </div>

    </aside>
    
    <section class="left">
      <div class="brand">
        
        <div>
          <h1>Student Create your account</h1>
          <p class="lead">Join us — quick signup and secure access.</p>
        </div>
      </div>

      <form id="regForm" action="student_action_page.php" method="post" enctype="multipart/form-data">

      <div class="full">
          <label for="avatar">Profile photo</label>
          <input id="avatar" name="image" type="file" accept="image/*">
          <div class="small">Upload a square photo (will be cropped).</div>
        </div>


        <div>
          <label for="fullname">First name</label>
          <input id="firstname" name="firstname" type="text" placeholder="Your firstname"  oninput="remove_validation('fnameErr');">
          <div class="error" id="fnameErr"></div>
        </div>

        <div>
          <label for="fullname">Last name</label>
          <input id="lastname" name="lastname" type="text" placeholder="Your lastname" oninput="remove_validation('lnameErr');">
          <div class="error" id="lnameErr"></div>
        </div>



         <div class="full">
          <label for="bio">Address</label>
          <textarea id="address" name="address" onkeyup="remove_validation('addressErr');"></textarea>
          <div class="error" id="addressErr"></div>
        </div>


        <div>
          <label for="dob">Date of Birth</label>
          <input id="dob" name="dob" type="date" placeholder="Confirm password" oninput="remove_validation('dobErr');">
          <div class="error" id="dobErr"></div>
        </div>

        <div>
          <label for="gender" id="gender">Gender</label>
          <div class="male">
				    <input type="radio" id="male" value="male" name="male_n" >
				    <h3 class="male">Male</h3>
            <div class="error" id="maleErr"></div>
          </div>
          <div class="female">
				     <input type="radio" id="female" value="female" name="male_n">
				     <h3 class="male">Female</h3>
             <div class="error" id="femaleErr"></div>
          </div>
        </div>


        <div>
          <label for="class">Class</label>
          <input id="class" name="class" type="text">
        </div>

        <div>
          <label for="department">Department</label>
          <input id="department" name="department" type="text">
        </div>



        <div>
          <label for="email">Email</label>
          <input id="email" name="emaill" type="email" placeholder="you@example.com" oninput="remove_validation('emailErr');">
          <div class="error" id="emailErr"></div>
        </div>

        <div>
          <label for="phone">Phone </label>
          <input id="phone" name="phone" type="text" placeholder="Enter your phone no" oninput="remove_validation('phoneErr');">
          <div class="error" id="phoneErr"></div>
        </div>

        <div>
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Create a strong password" oninput="remove_validation('pwdErr');">
          <div class="small" id="pwdStrength">Strength: —</div>
          <div class="error" id="pwdErr"></div>
        </div>

        <div>
          <label for="confirm">Confirm password</label>
          <input id="confirm" name="confirm" type="password" placeholder="Confirm password" oninput="remove_validation('confirmErr');">
          <div class="error" id="confirmErr"></div>
        </div>


        <div class="full row">
          <button type="submit" name="submit" class="btn">Create account</button>
          <div style="flex:1" aria-hidden></div>
        </div>

      </form>

      <div class="footer">Already have an account? <a href="login_new.php" style="color:var(--accent);text-decoration:none">Sign in</a></div>
    </section>

  </div>








  <script>

     // remove validation 
    function remove_validation(field)
    {
      const fnameErr = document.getElementById(field);
      fnameErr.innerHTML = '' ;
    }


    // small client-side validation + avatar preview
    const form = document.getElementById('regForm');
    const fnameErr = document.getElementById('fnameErr');
    const lnameErr = document.getElementById('lnameErr');
    const emailErr = document.getElementById('emailErr');
    const addressErr = document.getElementById('addressErr');
    const dobErr = document.getElementById('dobErr');
    const femaleErr = document.getElementById('femaleErr');
    const maleErr = document.getElementById('maleErr');
    const phoneErr = document.getElementById('phoneErr');
    const pwdErr = document.getElementById('pwdErr');
    const confirmErr = document.getElementById('confirmErr');
    const pwdStrength = document.getElementById('pwdStrength');
    const avatarInput = document.getElementById('avatar');
    const avatarBox = document.getElementById('avatarBox');

    function assessPassword(pw){
      let score = 0;
      if(pw.length >= 8) score++;
      if(/[A-Z]/.test(pw)) score++;
      if(/[0-9]/.test(pw)) score++;
      if(/[^A-Za-z0-9]/.test(pw)) score++;
      if(pw.length >= 12) score++;
      return score; // 0-5
    }

    document.getElementById('password').addEventListener('input', (e)=>{
      const s = assessPassword(e.target.value);
      const labels = ['Very weak','Weak','Okay','Good','Strong','Excellent'];
      pwdStrength.textContent = 'Strength: ' + labels[s];
    });

    avatarInput.addEventListener('change', (e)=>{
      const f = e.target.files && e.target.files[0];
      if(!f) return;
      const url = URL.createObjectURL(f);
      avatarBox.innerHTML = '';
      const img = document.createElement('img'); img.src = url; img.alt = 'avatar';
      avatarBox.appendChild(img);
    });

    function validEmail(v){
      return /\S+@\S+\.\S+/.test(v);
    }

    form.addEventListener('submit', (ev)=>{
      ev.preventDefault();
      // reset
      fnameErr.textContent = '';
      lnameErr.textContent = '';
      emailErr.textContent = '';
      addressErr.textContent = '';
      dobErr.textContent = '';
      femaleErr.textContent = '';
      maleErr.textContent = '';
      phoneErr.textContent = '';
      pwdErr.textContent = '';
      confirmErr.textContent = '';

      const first_name = form.firstname.value.trim();
      const last_name = form.lastname.value.trim();
      const email = form.email.value.trim();
      const address = form.address.value;
      const dob = form.dob.value;
      const female = form.female.value;
      const male = form.female.value;
      const phone = form.phone.value;
      const pw = form.password.value;
      const confirm = form.confirm.value;

      let ok = true;
      if(first_name.length < 2){ fnameErr.textContent = 'Please enter your first name.'; ok=false }
      if(last_name.length < 2){ lnameErr.textContent = 'Please enter your last name.'; ok=false }
      if(!validEmail(email)){ emailErr.textContent = 'Please enter a valid email.'; ok=false }
      if(assessPassword(pw) < 3){ pwdErr.textContent = 'Password is too weak. Use longer with numbers and symbols.'; ok=false }
      if(pw !== confirm){ confirmErr.textContent = 'Passwords do not match.'; ok=false }
      if(address === ""){ addressErr.textContent = 'Please enter your address.'; ok=false }
      if(!dob){dobErr.textContent = 'Date of birth is required !'; ok=false }
      if(female.checked == false && male.checked == false)
				{
					alert("please select gender");
					ok=false;
				}
      if(phone === ""){phoneErr.textContent = 'Enter valid phone number.'; ok=false }

      if(!ok) return;

      // mock success — in a real app you'd POST to your backend
    
      form.reset();
      avatarBox.innerHTML = '<div style="text-align:center;padding:10px;color:var(--muted)"><div style="font-size:18px;font-weight:700">Welcome!</div><div class="small">Upload a profile photo to preview here.</div></div>';
      pwdStrength.textContent = 'Strength: —';
    });

    
  </script>
</body>
</html>










