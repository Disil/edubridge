const form = document.getElementById('signup-form');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  // Here, you would typically send the user data to your server for registration
  // and handle the response accordingly (e.g., redirect to login page or show an error message)
  console.log('Name:', name);
  console.log('Email:', email);
  console.log('Password:', password);

  // Reset the form after submission
  form.reset();
});