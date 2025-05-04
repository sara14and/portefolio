// assets/js/script.js
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
        memoji.src = flipped
          ? 'assets/photos/memoji2.png'
          : 'assets/photos/memoji.png';
        memoji.classList.remove('spin');
        spinning = false;
      }, 1000);
    });
  }

  // === SEARCH FUNCTIONALITY ===
  const searchForm  = document.getElementById('searchForm');
  const searchInput = document.getElementById('globalSearch');
  const matchInfo   = document.getElementById('matchInfo');
  const resetBtn    = document.getElementById('resetSearch');
  let   matchIndex  = 0;
  let   matches     = [];

  function clearQueryParam() {
    const url = new URL(window.location);
    url.searchParams.delete('q');
    window.history.replaceState({}, '', url);
  }

  function clearHighlights() {
    document.querySelectorAll('.highlight').forEach(span => {
      const parent = span.parentNode;
      parent.replaceChild(
        document.createTextNode(span.textContent),
        span
      );
      parent.normalize();
    });
    matches = [];
    matchInfo.textContent = '';
  }

  function highlightMatches(term) {
    clearHighlights();
    if (!term) return;
  
    const regex = new RegExp(`(${term})`, 'gi');
    document.querySelectorAll('h2, h3, p, li')
      .forEach(el => {
        if (regex.test(el.textContent)) {
          el.innerHTML = el.textContent.replace(
            regex,
            '<span class="highlight">$1</span>'
          );
        }
      });
  
    matches = Array.from(document.querySelectorAll('.highlight'));
    if (matches.length) {
      matchIndex = 0;
      matches[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
  
      // singular / plural
      if (matches.length === 1) {
        matchInfo.textContent = i18n.match_one.replace("{count}", "1");
      } else {
        matchInfo.textContent = i18n.match_other.replace("{count}", matches.length);
      }
    } else {
      matchInfo.textContent = i18n.no_results;
    }
    clearQueryParam();
  }  
  

  // on load, if ?q=… present, apply
  const params = new URLSearchParams(window.location.search);
  const term   = params.get('q');
  if (term) {
    searchInput.value = term;
    highlightMatches(term);
  }

  searchForm.addEventListener('submit', e => {
    e.preventDefault();
    const value = searchInput.value.trim();
    if (!value) {
      alert(i18n.search_empty);
      return;
    }
    const url = new URL(window.location);
    url.searchParams.set('q', value);
    window.history.replaceState({}, '', url);
    highlightMatches(value);
  });

  // cycle to next match on Enter
  searchInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' && matches.length > 1) {
      e.preventDefault();
      matchIndex = (matchIndex + 1) % matches.length;
      matches[matchIndex].scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // reset search
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
if (form) {
  form.addEventListener('submit', e => {
        e.preventDefault();
    let valid = true;

    // clear previous errors
    form.querySelectorAll('input, textarea').forEach(el => {
      el.classList.remove('error');
    });
    form.querySelectorAll('.error-msg').forEach(span => {
      span.textContent = '';
    });

    function showError(el, msg) {
      el.classList.add('error');
      el.parentNode.querySelector('.error-msg').textContent = msg;
      valid = false;
    }

    const nameEl    = form.elements['name'];
    const emailEl   = form.elements['email'];
    const messageEl = form.elements['message'];

    // Validate name
    if (!nameEl.value.trim()) {
      showError(nameEl, i18n.name_req);
    }

    // Validate email
    const emailVal = emailEl.value.trim();
    const emailRx  = /^\S+@\S+\.\S+$/;
    if (!emailVal || !emailRx.test(emailVal)) {
      showError(emailEl, i18n.email_req);
    }

    // Validate message
    if (!messageEl.value.trim()) {
      showError(messageEl, i18n.message_req);
    }

    if (valid) {
      form.submit();
    } else {
      form.querySelector('.error').focus();
    }
  });
}

});