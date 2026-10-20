(function () {
    'use strict';
    function enhance() {
        document.querySelectorAll('.float-contact button.chat-zalo, .float-contact button.hotline').forEach(function (button) {
            var link = button.querySelector('a[href]');
            if (!link || link.parentElement !== button || button.classList.contains('mtt-contact-icon')) return;
            var label = link.getAttribute('aria-label') || link.textContent.trim();
            if (!label) label = button.classList.contains('chat-zalo') ? 'Chat Zalo' : 'Gọi điện';
            var icon = document.createElement('span');
            icon.className = 'mtt-contact-glyph';
            icon.setAttribute('aria-hidden', 'true');
            link.textContent = '';
            link.appendChild(icon);
            link.setAttribute('aria-label', label);
            if (!link.hasAttribute('title')) link.setAttribute('title', label);
            button.setAttribute('tabindex', '-1');
            button.setAttribute('type', 'button');
            button.classList.add('mtt-contact-icon');
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', enhance);
    else enhance();
}());
