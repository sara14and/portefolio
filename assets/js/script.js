document.addEventListener('DOMContentLoaded', () => {
  // === THEME TOGGLE ===
  const toggle = document.getElementById('theme-toggle');
  toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    const label = document.body.classList.contains('dark')
      ? i18n.theme_light_label
      : i18n.theme_dark_label;
    toggle.setAttribute('aria-label', label);
  });

  // === MEMOJI SWAP ===
  const memoji = document.getElementById('memoji');
  if (memoji) {
    let flipped = false, spinning = false;
    memoji.addEventListener('click', () => {
      if (spinning) return;
      spinning = true;
      memoji.classList.add('spin');
      setTimeout(() => {
        flipped = !flipped;
        memoji.src = flipped ? 'assets/photos/memoji2.png' : 'assets/photos/memoji.png';
        memoji.classList.remove('spin');
        spinning = false;
      }, 1000);
    });
  }

  // === SEARCH FUNCTIONALITY ===
  const searchForm = document.getElementById('searchForm');
  const searchInput = document.getElementById('globalSearch');
  const matchInfo = document.getElementById('matchInfo');
  const resetBtn = document.getElementById('resetSearch');
  let matchIndex = 0;
  let matches = [];

  function clearHighlights() {
    document.querySelectorAll('.highlight').forEach(span => {
      const parent = span.parentNode;
      parent.replaceChild(document.createTextNode(span.textContent), span);
      parent.normalize();
    });
    matches = [];
    matchInfo.textContent = '';
  }

  function highlightMatches(term) {
    clearHighlights();
    if (!term) return;

    const regex = new RegExp(`(${term})`, 'gi');
    document.querySelectorAll('section, .card-content, h2, h3, p, li').forEach(el => {
      if (regex.test(el.textContent)) {
        el.innerHTML = el.innerHTML.replace(regex, '<span class="highlight" aria-label="search match">$1</span>');
      }
    });

    matches = Array.from(document.querySelectorAll('.highlight'));
    if (matches.length) {
      matchIndex = 0;
      matches[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      matchInfo.textContent = `${matches.length} match${matches.length > 1 ? 'es' : ''} found`;
    } else {
      matchInfo.textContent = `No results found`;
    }
  }

  const params = new URLSearchParams(window.location.search);
  const term = params.get('q');
  if (term) {
    searchInput.value = term;
    highlightMatches(term);
  }

  searchForm.addEventListener('submit', e => {
    e.preventDefault();
    const value = searchInput.value.trim();
    if (value) {
      const url = new URL(window.location);
      url.searchParams.set('q', value);
      window.history.replaceState({}, '', url);
      highlightMatches(value);
    }
  });

  searchInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' && matches.length > 1) {
      e.preventDefault();
      matchIndex = (matchIndex + 1) % matches.length;
      matches[matchIndex].scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  resetBtn.addEventListener('click', () => {
    searchInput.value = '';
    const url = new URL(window.location);
    url.searchParams.delete('q');
    window.history.replaceState({}, '', url);
    clearHighlights();
  });

  // === AJAX: Projects ===
  document.querySelectorAll('.btn-view-desc').forEach(btn => {
    btn.addEventListener('click', async () => {
      const card = btn.closest('.card');
      const detail = card.querySelector('.detail');
      const id = card.dataset.id;
      if (detail.style.display === 'block') {
        detail.style.display = 'none';
        btn.textContent = i18n.view_desc;
        return;
      }
      btn.disabled = true;
      btn.textContent = i18n.loading;
      try {
        const res = await fetch(`api/project_detail.php?id=${id}`);
        const json = await res.json();
        detail.innerHTML = `<p>${json.description}</p>`;
        detail.style.display = 'block';
        btn.textContent = i18n.hide_desc;
      } catch {
        detail.textContent = 'Error loading.';
        detail.style.display = 'block';
        btn.textContent = i18n.hide_desc;
      } finally {
        btn.disabled = false;
      }
    });
  });

  // === AJAX: Experience ===
  document.querySelectorAll('.btn-view-desc-exp').forEach(btn => {
    btn.addEventListener('click', async () => {
      const card = btn.closest('.card');
      const detail = card.querySelector('.detail');
      const key = card.dataset.key;
      if (detail.style.display === 'block') {
        detail.style.display = 'none';
        btn.textContent = i18n.view_desc;
        return;
      }
      btn.disabled = true;
      btn.textContent = i18n.loading;
      try {
        const res = await fetch(`api/experience_detail.php?key=${encodeURIComponent(key)}`);
        const json = await res.json();
        detail.innerHTML = '<ul>' + json.points.map(pt => `<li>${pt}</li>`).join('') + '</ul>';
        detail.style.display = 'block';
        btn.textContent = i18n.hide_desc;
      } catch {
        detail.textContent = 'Error loading.';
        detail.style.display = 'block';
        btn.textContent = i18n.hide_desc;
      } finally {
        btn.disabled = false;
      }
    });
  });

  // === JS FORM VALIDATION (Contact) ===
  const form = document.getElementById('contactForm');
  form.addEventListener('submit', e => {
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
