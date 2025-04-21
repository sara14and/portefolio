// assets/js/script.js
document.addEventListener('DOMContentLoaded', () => {
    // theme toggle
    const toggle = document.getElementById('theme-toggle');
    toggle.addEventListener('click', () => {
      document.body.classList.toggle('dark');
      const label = document.body.classList.contains('dark')
        ? i18n.theme_light_label
        : i18n.theme_dark_label;
      toggle.setAttribute('aria-label', label);
      
    });

    // photo click = spin and swap image
  const memoji = document.getElementById('memoji');
  let flipped = false;

  memoji.addEventListener('click', () => {
    memoji.classList.add('spin');

    setTimeout(() => {
      flipped = !flipped;
      memoji.src = flipped
        ? 'assets/photos/memoji2.png'
        : 'assets/photos/memoji.png';
      memoji.classList.remove('spin');
    }, );
  });

  
    // AJAX: project descriptions
    document.querySelectorAll('.btn-view-desc').forEach(btn => {
      btn.addEventListener('click', async () => {
        const card   = btn.closest('.card'),
              detail = card.querySelector('.detail'),
              id     = card.dataset.id;
  
        if (detail.style.display === 'block') {
          detail.style.display = 'none';
          btn.textContent      = i18n.view_desc;
          return;
        }
  
        btn.disabled    = true;
        btn.textContent = i18n.loading;
  
        try {
          const res  = await fetch(`api/project_detail.php?id=${id}`),
                json = await res.json();
          detail.innerHTML     = `<p>${json.description}</p>`;
          detail.style.display = 'block';
          btn.textContent      = i18n.hide_desc;
        } catch {
          detail.textContent   = 'Error loading.';
          detail.style.display = 'block';
          btn.textContent      = i18n.hide_desc;
        } finally {
          btn.disabled = false;
        }
      });
    });
  
    // AJAX: experience descriptions
    document.querySelectorAll('.btn-view-desc-exp').forEach(btn => {
      btn.addEventListener('click', async () => {
        const card   = btn.closest('.card'),
              detail = card.querySelector('.detail'),
              key    = card.dataset.key;
  
        if (detail.style.display === 'block') {
          detail.style.display = 'none';
          btn.textContent      = i18n.view_desc;
          return;
        }
  
        btn.disabled    = true;
        btn.textContent = i18n.loading;
  
        try {
          const res  = await fetch(
                           `api/experience_detail.php?key=${encodeURIComponent(key)}`
                         ),
                json = await res.json();
          detail.innerHTML     =
            '<ul>' + json.points.map(pt => `<li>${pt}</li>`).join('') + '</ul>';
          detail.style.display = 'block';
          btn.textContent      = i18n.hide_desc;
        } catch {
          detail.textContent   = 'Error loading.';
          detail.style.display = 'block';
          btn.textContent      = i18n.hide_desc;
        } finally {
          btn.disabled = false;
        }
      });
    });

    // POST: contact form JS validation
        const form = document.getElementById('contactForm');
        form.addEventListener('submit', function (e) {
        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const message = form.message.value.trim();

        let error = '';
        if (!name) error = 'Name is required.';
        else if (!email || !/^\S+@\S+\.\S+$/.test(email)) error = 'Valid email is required.';
        else if (!message) error = 'Message is required.';

        if (error) {
            e.preventDefault();
            alert(error);
        }
        });

  });
  