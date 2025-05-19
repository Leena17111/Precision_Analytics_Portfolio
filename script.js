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
  const name    = document.getElementById('name')?.value.trim() ?? '';
  const email   = document.getElementById('email')?.value.trim() ?? '';
  const subject = document.getElementById('subject')?.value.trim() ?? '';
  const message = document.getElementById('message')?.value.trim() ?? '';

  let errors = [];

  if (!name) errors.push('Name is required.');
  if (!email) errors.push('Email is required.');
  else {
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
    if (!emailPattern.test(email)) errors.push('Email invalid.');
  }
  if (!subject) errors.push('Subject is required.');
  if (!message) errors.push('Message is required.');

  if (errors.length > 0) {
    alert(errors.join('\n'));
    event.preventDefault();  // <== This prevents the form from submitting
  } else {
    alert("Form submitted correctly, you'll hear from us shortly.");
  }
}

// add validation part only when needed in a page
document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', validateForm);
  }
});
