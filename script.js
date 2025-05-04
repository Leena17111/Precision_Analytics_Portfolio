function validateForm(event) {
    event.preventDefault();

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let subject = document.getElementById("subject").value.trim();
    let message = document.getElementById("message").value.trim();

    if (name === "") {
      alert("Name is required.");
      return false;
    }

    if (email === "") {
      alert("Email is required.");
      return false;
    }

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
      alert("Email invalid.");
      return false;
    }

    if (subject === "") {
      alert("Subject is required.");
      return false;
    }

    if (message === "") {
      alert("Message is required.");
      return false;
    }

    alert("Form submitted correctly, you'll hear from us shortly.");
    document.getElementById("contactForm").reset();
    return true;
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("contactForm").addEventListener("submit", validateForm);
  });
