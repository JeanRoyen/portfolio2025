const cards = document.querySelectorAll('.project-card');

cards.forEach(card => card.classList.add('is-hidden'));

const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            entry.target.classList.remove('is-hidden');
            obs.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });

cards.forEach(card => observer.observe(card));
