(function () {
    'use strict';
    function enhance() {
        document.querySelectorAll('.float-contact').forEach(function (container) {
            if (!container.querySelector('button.chat-zalo, button.hotline') || container.querySelector('.mtt-contact-map')) return;
            var map = document.createElement('a');
            map.className = 'mtt-contact-map';
            map.setAttribute('href', 'https://maps.app.goo.gl/DEL3w4oQjD171L8f9');
            map.setAttribute('target', '_blank');
            map.setAttribute('rel', 'noopener noreferrer');
            map.setAttribute('aria-label', 'Xem địa chỉ MTT VINA trên Google Maps');
            map.setAttribute('title', 'Google Maps — MTT VINA');
            var pin = document.createElement('span');
            pin.className = 'mtt-contact-glyph';
            pin.setAttribute('aria-hidden', 'true');
            map.appendChild(pin);
            container.insertBefore(map, container.firstChild);
        });
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
