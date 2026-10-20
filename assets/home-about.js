(function () {
    'use strict';
    var section = document.querySelector('.mtt-vina-about');
    if (!section || !('IntersectionObserver' in window) ||
        window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }
    // Observe the strengths, not the full section: the latter can exceed a mobile viewport.
    var target = section.querySelector('.mtt-vina-about__strengths');
    if (!target) { return; }
    try {
        var observer = new IntersectionObserver(function (entries) {
            if (entries.some(function (entry) { return entry.isIntersecting; })) {
                section.classList.add('is-visible');
                observer.disconnect();
            }
        }, { threshold: 0.1 });
        observer.observe(target);
        section.classList.add('is-animated');
    } catch (error) {
        section.classList.remove('is-animated');
    }
}());
