function qs(sel, root = document) {
  return root.querySelector(sel);
}

function qsa(sel, root = document) {
  return Array.from(root.querySelectorAll(sel));
}

function initSlideshow() {
  const container = qs('[data-slideshow]');
  if (!container) return;

  const slides = qsa('.slide', container);
  if (slides.length === 0) return;

  let idx = 0;
  slides[idx].classList.add('active');

  setInterval(() => {
    slides[idx].classList.remove('active');
    idx = (idx + 1) % slides.length;
    slides[idx].classList.add('active');
  }, 3000);
}

function initDestinationModal() {
  const modal = qs('#destinationModal');
  if (!modal) return;

  const panelTitle = qs('[data-modal-title]', modal);
  const panelMeta = qs('[data-modal-meta]', modal);
  const panelDesc = qs('[data-modal-desc]', modal);
  const panelImg = qs('[data-modal-img]', modal);
  const closeBtn = qs('[data-close-modal]', modal);

  function openModal(data) {
    panelTitle.textContent = data.name;
    panelMeta.textContent = `${data.country} • Best time: ${data.bestTime}`;
    panelDesc.textContent = data.description;
    panelImg.src = data.imageUrl;
    panelImg.alt = data.name;

    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    if (closeBtn) closeBtn.focus();
  }

  function closeModal() {
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal || e.target.matches('[data-close-modal]')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  qsa('[data-destination-card]').forEach((card) => {
    card.addEventListener('click', (e) => {
      if (e.target.closest('a')) return;

      const data = {
        name: card.getAttribute('data-name') || '',
        country: card.getAttribute('data-country') || '',
        description: card.getAttribute('data-description') || '',
        imageUrl: card.getAttribute('data-image-url') || '',
        bestTime: card.getAttribute('data-best-time') || '',
      };

      openModal(data);
    });

    card.addEventListener('keydown', (e) => {
      if (e.key !== 'Enter' && e.key !== ' ') return;
      e.preventDefault();

      const data = {
        name: card.getAttribute('data-name') || '',
        country: card.getAttribute('data-country') || '',
        description: card.getAttribute('data-description') || '',
        imageUrl: card.getAttribute('data-image-url') || '',
        bestTime: card.getAttribute('data-best-time') || '',
      };

      openModal(data);
    });
  });
}

function initContactValidation() {
  const form = qs('#contactForm');
  if (!form) return;

  const nameEl = qs('#fullName');
  const emailEl = qs('#email');
  const messageEl = qs('#message');
  const statusEl = qs('#formStatus');

  function setStatus(msg, ok) {
    statusEl.textContent = msg;
    statusEl.className = ok ? 'help success' : 'help error';
  }

  form.addEventListener('submit', (e) => {
    const name = (nameEl.value || '').trim();
    const email = (emailEl.value || '').trim();
    const message = (messageEl.value || '').trim();

    const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    if (!name || !email || !message) {
      e.preventDefault();
      setStatus('Please fill in all required fields.', false);
      return;
    }

    if (!emailOk) {
      e.preventDefault();
      setStatus('Please enter a valid email address.', false);
      return;
    }

    setStatus('Looks good! Your message is ready to send.', true);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initSlideshow();
  initDestinationModal();
  initContactValidation();
});
