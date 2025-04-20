document.addEventListener("DOMContentLoaded", () => {
    // ————— AJAX “Voir plus de projets” —————
    const btn = document.getElementById("loadMore");
    const container = document.getElementById("moreProjects");
    if (btn) {
      btn.addEventListener("click", () => {
        fetch("load_more_projects.php")
          .then(res => res.text())
          .then(data => {
            container.innerHTML += data;
            btn.style.display = "none";
          })
          .catch(err => console.error("Erreur AJAX :", err));
      });
    }
  
    // ————— Contact Form Validation (POST) —————
    const form = document.getElementById("contactForm");
    if (form) {
      form.addEventListener("submit", function (e) {
        const name    = form.elements["name"].value.trim();
        const email   = form.elements["email"].value.trim();
        const message = form.elements["message"].value.trim();
        let valid = true;
        if (!name)                                valid = false;
        if (!email || !/^\S+@\S+\.\S+$/.test(email)) valid = false;
        if (!message)                             valid = false;
        if (!valid) {
          alert("Please complete all fields with valid information.");
          e.preventDefault();
        }
      });
    }
  });
  