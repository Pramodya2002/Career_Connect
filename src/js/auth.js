var tB;
var loginContainer;
var regContainer;

var errorContainer;
var errors;

var l_email;
var l_passwd;
var pLValidity = false;
var eLValidity = false;

var r_email;
var r_toggle_switch;
var brief_prof_email;
var brief_prof_type;
var r_pass;
var r_rpass;
var r_btn;
var r_pass_error;
var brief_prof;
var eRValidity = false;
var pRValidity = false;
var pRRValidity = false;

var loginDynStyle = document.head.appendChild(document.createElement("style"));
var lPasswdDynStyle = document.head.appendChild(document.createElement("style"));

var regDynStyle = document.head.appendChild(document.createElement("style"));
var rPasswdDynStyle = document.head.appendChild(document.createElement("style"));
var rRPasswdDynStyle = document.head.appendChild(document.createElement("style"));


document.addEventListener("DOMContentLoaded", function (e) {
	//alert("hj");
	loginContainer = document.getElementById("log");
	regContainer = document.getElementById("reg");
	tB = document.getElementById("tog");

	errorContainer = document.getElementById("error-container");

	l_email = document.getElementById("l-email");
	l_passwd = document.getElementById("l-passwd");

	r_email = document.getElementById("r-email");
	r_toggle_switch = document.getElementById("r-toggle-switch");
	brief_prof = document.getElementById("brief-profile");
	brief_prof_email = document.getElementById('r_bp_email');
	brief_prof_type = document.getElementById('r_bp_type');
	r_passwd = document.getElementById("r-passwd");
	r_rpasswd = document.getElementById("r-rpasswd");
	r_btn = document.getElementById("r-btn");
	r_pass_error = document.getElementById("reg-pass-error");

	errorAnimations();
	/*		
		for(let i = 0; i < errors.length; i++){
			setTimeout(() => {
				//errors[errors.length - i-1].addEventListener('animationend', addSlideOut(errors[errors.length - i-1]));
			},d);
			d += 400;	
		}
	*/
	loginContainer.addEventListener('animationend', removeAnimationClasses);
	regContainer.addEventListener('animationend', removeAnimationClasses);

	r_email.addEventListener('animationend', removeAnimationClasses);
	r_passwd.addEventListener('animationend', removeAnimationClasses);
	r_rpasswd.addEventListener('animationend', removeAnimationClasses);
});

let errorAnimations = (() => {
	errors = Array.from(errorContainer.children);
	let d = 0;

	errors.forEach((c) => {
		setTimeout(() => {
			c.style.display = 'flex';
			c.classList.add('error-slideIn');
			c.addEventListener('animationend', addErrorSlideOut(c));
		}, d);
		d += 250;
	});

	d = 0;
});

function removeAnimationClasses() {

	loginContainer.classList.remove('slideIn');
	loginContainer.classList.remove('slideOut');
	regContainer.classList.remove('slideIn');
	regContainer.classList.remove('slideOut');
	tB.setAttribute('onclick', 'toggleMode()');

	r_email.classList.remove('slideIn');
	r_email.classList.remove('slideOut');
	r_toggle_switch.classList.remove('slideIn');
	r_toggle_switch.classList.remove('slideOut');
	brief_prof.classList.remove('slideIn');
	brief_prof.classList.remove('slideOut');
	r_passwd.classList.remove('slideIn');
	r_passwd.classList.remove('slideOut');
	r_rpasswd.classList.remove('slideIn');
	r_rpasswd.classList.remove('slideOut');
	r_pass_error.classList.remove('slideIn');
	r_pass_error.classList.remove('slideOut');

}

function toggleMode() {
	tB.setAttribute('onclick', '');
	if (tB.innerText == "CREATE ACCOUNT >") {
		loginContainer.classList.add('slideOut');
		setTimeout(() => {
			loginContainer.style.display = 'none';
			regContainer.style.display = 'flex';
			void regContainer.offsetHeight;
			regContainer.classList.add('slideIn');
		}, 500);
		tB.innerText = "LOGIN >"
	} else {
		regContainer.classList.add('slideOut');
		setTimeout(() => {
			regContainer.style.display = 'none';
			loginContainer.style.display = 'flex';
			void loginContainer.offsetHeight;
			loginContainer.classList.add('slideIn');
		}, 500);
		tB.innerText = "CREATE ACCOUNT >"
	}
};



function addErrorSlideOut(c) {
	setTimeout(() => {
		c.classList.remove('error-slideIn');
		c.classList.add('error-slideOut');
		setTimeout(() => {
			c.style.display = 'none';
			c.classList.remove('error-slideOut');
		}, 3000)
		//c.addEventListener('animationend', remErrorSlideOut(c));
	}, 3000);
}

function remErrorSlideOut(c) {
	c.classList.remove('error_slideOut');
}



let checkEmail = (() => {
	let pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

	eLValidity = l_email.value.toLowerCase().match(pattern);

	// Overriding the email validation for the default account
	if (l_email.value == "uoc" || l_email.value == "admin") {
		eLValidity = true;
	}

	if (eLValidity) {
		l_email.style.border = "2px solid green";
		loginDynStyle.innerHTML = "#l-email-icon::before {border: 2px solid green; border-width: 2px 0px 2px 2px;}";
	} else {
		l_email.style.border = "2px solid red";
		loginDynStyle.innerHTML = "#l-email-icon::before {border: 2px solid red; border-width: 2px 0px 2px 2px;}";
	}

});

let checkREmail = (() => {
	let pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	eRValidity = r_email.value.toLowerCase().match(pattern);

	// Overriding the email validation for the default account
	if (r_email.value == "uoc") {
		eRValidity = true;
	}

	if (eRValidity) {
		r_email.style.border = "2px solid green";
		regDynStyle.innerHTML = "#r-email-icon::before {border: 2px solid green; border-width: 2px 0px 2px 2px;}";
	} else {
		r_email.style.border = "2px solid red";
		regDynStyle.innerHTML = "#r-email-icon::before {border: 2px solid red; border-width: 2px 0px 2px 2px;}";
	}
});


let checkPasswd = (() => {
	let passwd = l_passwd.value;
	let pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	pLValidity = pattern.test(passwd);

	// Overriding the password validation for the default account
	if (l_passwd.value == "ucsc") {
		pLValidity = true;
	}

	if (pLValidity) {
		l_passwd.style.border = "2px solid green";
		lPasswdDynStyle.innerHTML = "#l-passwd-icon::before {border: 2px solid green; border-width: 2px 0px 2px 2px;}";
	} else {
		l_passwd.style.border = "2px solid red";
		lPasswdDynStyle.innerHTML = "#l-passwd-icon::before {border: 2px solid red; border-width: 2px 0px 2px 2px;}";
	}
});

let checkRPasswd = (() => {
	let passwd = r_passwd.value;
	let pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	pRValidity = pattern.test(passwd);

	r_pass_error.innerHTML = "";

	// Overriding the password validation for the default account
	if (r_passwd.value == "ucsc") {
		pRValidity = true;
	}

	if (pRValidity) {
		r_passwd.style.border = "2px solid green";
		rPasswdDynStyle.innerHTML = "#r-passwd-icon::before {border: 2px solid green; border-width: 2px 0px 2px 2px;}";
	} else {
		//let missing = [];
		// Check for lowercase letter
		if (!/[a-z]/.test(passwd)) {
			r_pass_error.innerHTML += "<li>At least 1 lowercase letter</li>";
			//  missing.push("At least 1 lowercase letter");
		}

		// Check for uppercase letter
		if (!/[A-Z]/.test(passwd)) {
			r_pass_error.innerHTML += "<li>At least 1 uppercase letter</li>";
			//missing.push("At least 1 uppercase letter");
		}

		// Check for digit
		if (!/[0-9]/.test(passwd)) {
			r_pass_error.innerHTML += "<li>At least 1 digit</li>";
			//missing.push("At least 1 digit");
		}

		// Check for special character
		if (!/[!@#\$%\^&\*]/.test(passwd)) {
			r_pass_error.innerHTML += "<li>At least 1 special character</li>";
			//missing.push("At least 1 special character");
		}

		// Check for minimum length
		if (passwd.length < 8) {
			r_pass_error.innerHTML += "<li>Minimum length of 8 characters</li>";
			//missing.push("Minimum length of 8 characters");
		}

		r_passwd.style.border = "2px solid red";
		rPasswdDynStyle.innerHTML = "#r-passwd-icon::before {border: 2px solid red; border-width: 2px 0px 2px 2px;}";
	}
});

let checkRRPasswd = (() => {
	let passwd = r_passwd.value;
	let rPasswd = r_rpasswd.value;

	pRRValidity = (passwd == rPasswd ? 1 : 0);

	if (pRRValidity) {
		r_rpasswd.style.border = "2px solid green";
		rRPasswdDynStyle.innerHTML = "#r-rpasswd-icon::before {border: 2px solid green; border-width: 2px 0px 2px 2px;}";
	} else {
		r_rpasswd.style.border = "2px solid red";
		rRPasswdDynStyle.innerHTML = "#r-rpasswd-icon::before {border: 2px solid red; border-width: 2px 0px 2px 2px;}";
	}
});

let validateLogin = (() => {

	if (!eLValidity) {
		console.log("wrong e");
		errorContainer.innerHTML = "<div class='error error_slideIn'>Invalid Email Address</div>";
		errorAnimations();
		return false;
	} else if (!pLValidity) {
		console.log("wrong p");
		errorContainer.innerHTML = "<div class='error error_slideIn'>Invalid Password</div>";
		errorAnimations();
		return false;
	} else {
		return true;
	}
});

let validateReg = (() => {

	if (!eRValidity) {
		console.log("wrong e");
		errorContainer.innerHTML = "<div class='error error_slideIn'>Invalid Email Address</div>";
		errorAnimations();
		return false;
	} else if (!pRValidity) {
		errorContainer.innerHTML = "<div class='error error_slideIn'>Invalid Password</div>";
		errorAnimations();
		return false;
	} else if (!pRRValidity) {
		console.log("wrong rp");
		errorContainer.innerHTML = "<div class='error error_slideIn'>Conform Password And Password Fields Does Not Match</div>";
		errorAnimations();
		return false;
	} else {
		return true;
	}
});

let toggleNext = (() => {
	if (!eRValidity) {
		errorContainer.innerHTML = "<div class='error error_slideIn'>Invalid Email Address</div>";
		errorAnimations();
		return;
	}

	r_btn.setAttribute('onclick', '');

	$.ajax({
		type: 'GET',
		url: 'utils/check-email.php',
		data: { 'ajaxRequest': 'true', 'email': r_email.value },
		success: function (response) {

			if (response == "true") {
				errorContainer.innerHTML = "<div class='error'error_slideIn>Email Already Exists</div>";
				errorAnimations();

				r_btn.setAttribute('onclick', 'toggleNext()');
			} else {

				if (r_btn.getAttribute('value') == "Next >") {
					brief_prof_email.innerHTML = r_email.value;
					brief_prof_type.appendChild(r_toggle_switch);

					r_email.parentElement.classList.add('slideOut');
					r_toggle_switch.classList.add('slideOut');
					setTimeout(() => {
						r_email.parentElement.style.display = 'none';
						//r_toggle_switch.style.display = 'none';
						brief_prof.style.display = 'flex';
						r_passwd.parentElement.style.display = 'flex';
						r_rpasswd.parentElement.style.display = 'flex';
						r_pass_error.style.display = 'block';
						void regContainer.offsetHeight;
						brief_prof.classList.add('slideIn');
						r_passwd.parentElement.classList.add('slideIn');
						r_rpasswd.parentElement.classList.add('slideIn');
						r_pass_error.classList.add('slideIn');

						//regContainer.childNodes[0].removeChild(r_toggle_switch);
						r_btn.setAttribute('type', 'submit');
					}, 500);
					r_btn.setAttribute('value', 'Sign Up');
				} else {

				}
			}
		}
	});
});
