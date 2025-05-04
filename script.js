/* ==========  HAMBURGER NAV  ========== */
const navToggle = document.querySelector('.nav-toggle');
const navLinks  = document.querySelector('.nav-links');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('show');
  });
}

/* ==========  CONTACT-FORM VALIDATION  ========== */
function validateForm(event) {
  event.preventDefault();                     

  const name    = document.getElementById('name')    ?.value.trim() ?? '';
  const email   = document.getElementById('email')   ?.value.trim() ?? '';
  const subject = document.getElementById('subject') ?.value.trim() ?? '';
  const message = document.getElementById('message') ?.value.trim() ?? '';

  /*  all error messages requested by the user  */
  if (!name)           { alert('Name is required.');                return false; }
  if (!email)          { alert('Email is required.');               return false; }

  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;                
  if (!emailPattern.test(email)) {
    alert('Email invalid.');
    return false;
  }

  if (!subject)        { alert('Subject is required.');             return false; }
  if (!message)        { alert('Message is required.');             return false; }

  alert("Form submitted correctly, you'll hear from us shortly.");
  event.target.reset();                                          
  return true;
}

// add validation part only when needed in a page
document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', validateForm);
  }
});
