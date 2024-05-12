const navLinks = document.querySelectorAll('.nav-link');
const pages = document.querySelectorAll('.page');
const subMenus = document.querySelectorAll('.sub-menu');

// Toggle active class for navigation links
navLinks.forEach((link) => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    navLinks.forEach((link) => link.classList.remove('active'));
    e.target.classList.add('active');

    const targetPage = document.getElementById(`${e.target.textContent.toLowerCase().replace(' ', '-')}-page`);
    pages.forEach((page) => page.classList.remove('active'));
    targetPage.classList.add('active');
  });
});

// Toggle sub-menus
subMenus.forEach((subMenu) => {
  const parent = subMenu.parentNode;
  const parentLink = parent.querySelector('.nav-link');

  parentLink.addEventListener('click', (e) => {
    e.preventDefault();
    subMenu.style.display = subMenu.style.display === 'none' ? 'block' : 'none';
  });
});