const form = document.getElementById('login-form');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // Here, you would typically send the username and password to your server for authentication
  // and handle the response accordingly (e.g., redirect to dashboard or show an error message)
  console.log('Username:', username);
  console.log('Password:', password);

  // Reset the form after submission
  form.reset();
});